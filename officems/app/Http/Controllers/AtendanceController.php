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
    $month = $request->get('month'); // "yyyy-mm"
    $userType = $request->get('user_type'); // "lectures" or "demonstrators"

    // Build query
    $query = Atendance::query();

    if ($month) {
        // Extract the month and year from the database format "dd/mm/yyyy"
        $parsedMonth = \Carbon\Carbon::createFromFormat('Y-m', $month);
        $monthNumber = $parsedMonth->format('m'); // Extract "03"
        $yearNumber = $parsedMonth->format('Y'); // Extract "2025"

        $query->whereRaw("STR_TO_DATE(month, '%d/%m/%Y') BETWEEN ? AND ?", [
            "{$yearNumber}-{$monthNumber}-01",
            "{$yearNumber}-{$monthNumber}-31"
        ]);
    }

    if ($userType) {
        $query->where('user_type', $userType);
    }

    // Get results
    $attendances = $query->get();

  
    $data = [];

    foreach ($attendances as $a) {
        // Determine the present value
        $c = ($a->present == 2) ? 1 : 0.5;

        // Check if employee record already exists in the array
        if (isset($data[$a->emp_no])) {
            $data[$a->emp_no]['present'] += $c;
        } else {
            $data[$a->emp_no] = [
                'id' => $a->id,
                'emp_no' => $a->emp_no,
                'name' => $a->name,
                'present' => $c,
                'user_type' => $a->user_type
            ];
        }
    }

    // Distinct months for dropdown (optional)
    $months = Atendance::select('month')->distinct()->pluck('month');

    return view('attendance.index', compact('data', 'month', 'userType', 'months'));
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
            

            if (count($row) < 3) {
                // Skip invalid row
                continue;
            }

            $emp_no = $row[1];
            $name = $row[2];
            $in = $row[3];
            $out = $row[4];
            // $presenceData = array_slice($row, 3); 
            // e.g. [1,0,1,1,1,0,...]
            list($outHours, $outMinutes) = explode(":", $out);
            list($inHours, $inMinutes) = explode(":", $in);
            
            $minIn = ($inHours * 60) + $inMinutes;
            $minOut = ($outHours * 60) + $outMinutes;

            $tdif = $minOut - $minIn;


            $count = $tdif/60;
            $presentCount = 0;

            info(round($count));
            if(round($count) >= 8){ 
                $presentCount = 2;
            }else{
                $presentCount = 1;
            }
            info($presentCount);

            // Save in DB
            Atendance::create([
                'name' => $name,
                'emp_no' => $emp_no,
                'present' => $presentCount,
                'month'   => $request->month,  
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
        fputcsv($handle, ['ID', 'Emp No','Name', 'Present', 'Month', 'User Type']);

        // Add data rows
        foreach ($attendances as $att) {
            fputcsv($handle, [
                $att->id,
                $att->emp_no,
                $att->name,
                $att->present,
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
