<?php

namespace App\Http\Controllers;

use App\Models\Atendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AtendanceController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve filter parameters
        $month = $request->get('month');      // "mm/yyyy"
        $userType = $request->get('user_type'); // "lectures" or "demostrators"

        // Build query
        $query = Atendance::query();

        if ($month) {
            $query->where('month', $month);
        }
        if ($userType) {
            $query->where('user_type', $userType);
        }

        // Get results
        $attendances = $query->paginate(10);

        // Distinct months for dropdown (optional)
        $months = Atendance::select('month')->distinct()->pluck('month');
        
        return view('attendance.index', compact('attendances', 'month', 'userType', 'months'));
    }

    /**
     * Show form for uploading CSV.
     */
    public function create()
    {
        return view('attendance.create');
    }

    /**
     * Store the CSV file and parse attendance data.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'month' => 'required|string', // "mm/yyyy"
            'user_type' => 'required|string', // "lectures" or "demostrators"
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        // Store the file
        $path = $request->file('csv_file')->store('attendance_csvs', 'public');

        // Parse the CSV
        $file = Storage::disk('public')->path($path);
        $data = array_map('str_getcsv', file($file));

        // The first row is usually the header row
        // e.g. ["id", "name", "week 01", "week 01", ...] 
        // We'll skip it if needed.
        $header = $data[0]; // if you want to confirm or skip
        unset($data[0]); 
        unset($data[1]);   // remove header row

        // We'll parse each row, count present=1, absent=0
        foreach ($data as $row) {
            // Example CSV structure:
            // row = [id, name, week1, week2, ..., weekN]
            // You can adjust the indices to match your CSV

            // ID => $row[0] 
            // name => $row[1]
            // subsequent columns => presence data (1/0)

            // If your CSV has variable columns, handle carefully:
            // Let's assume the first two columns are id, name
            // and the rest are presence data.

            if (count($row) < 3) {
                // Skip invalid row
                continue;
            }

            $name = $row[1];
            $presenceData = array_slice($row, 2); 
            // e.g. [1,0,1,1,1,0,...]

            $presentCount = 0;
            $absentCount  = 0;

            foreach ($presenceData as $value) {
                // Trim whitespace and check if the value is empty
                $trimmedValue = trim($value);
            
                if ($trimmedValue === "") {
                    // Ignore empty values (do not count as present or absent)
                    continue;
                }
            
                // Convert to integer
                $value = (int) $trimmedValue;
            
                if ($value === 1) {
                    $presentCount++;
                } elseif ($value === 0) {
                    $absentCount++;
                }
            }

            // Save in DB
            Atendance::create([
                'name' => $name,
                'present' => $presentCount,
                'absent'  => $absentCount,
                'month'   => $request->month,    // "mm/yyyy"
                'user_type' => $request->user_type, 
                'file_path' => $path,
            ]);
        }

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance data uploaded and processed successfully!');
    }

    /**
     * Download the filtered attendance as CSV.
     */
    public function download(Request $request)
    {
        $month = $request->get('month');      // "mm/yyyy"
        $userType = $request->get('user_type'); // "lectures" or "demostrators"

        $query = Atendance::query();
        if ($month) {
            $query->where('month', $month);
        }
        if ($userType) {
            $query->where('user_type', $userType);
        }

        $attendances = $query->get();

        // Build CSV content
        $filename = "attendance_".($userType ?? 'all')."_".($month ?? 'all').".csv";
        $handle = fopen('php://temp', 'w');

        // Add header row
        fputcsv($handle, ['ID', 'Name', 'Present', 'Absent', 'Month', 'User Type']);

        // Add data rows
        foreach ($attendances as $att) {
            fputcsv($handle, [
                $att->id,
                $att->name,
                $att->present,
                $att->absent,
                $att->month,
                $att->user_type,
            ]);
        }

        rewind($handle);
        $csvContent = stream_get_contents($handle);
        fclose($handle);

        // Return CSV as download
        return response($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }
}
