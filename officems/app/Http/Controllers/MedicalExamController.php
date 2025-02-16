<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalExam;
use Illuminate\Support\Facades\Auth;

class MedicalExamController extends Controller
{

    public function index()
    {
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff') {
            $medicals = MedicalExam::paginate(10);
        }else{
            $medicals = MedicalExam::where('registation_number', Auth::user()->reg_no)->get();
        }

        return view('medical.index_exam', compact('medicals'));
    }

    public function create()
    {
        return view('medical.create_exam');
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'student_name' => 'required|string',
            'year' => 'required|string',
            'level' => 'required|string',
            'semester' => 'required|string',
            'registation_number' => 'required|string',
            'contact_number' => 'required|string',
            'degree_programe' => 'required|string',
            'subject_details' => 'required|array',
            'medical_details' => 'required|array',
            'agree' => 'required|boolean',
            'medical_image' => 'required|image|mimes:jpg,png,jpeg|max:2048', // Image Validation
        ]);

        // Handle medical image upload
        if ($request->hasFile('medical_image')) {
            $image = $request->file('medical_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/exam_medical'), $imageName);

            $imagePath = 'uploads/exam_medical/'.$imageName;
        }

        // Store data in the database
        MedicalExam::create([
            'student_name' => $request->student_name,
            'year' => $request->year,
            'level' => $request->level,
            'semester' => $request->semester,
            'registation_number' => $request->registation_number,
            'contact_number' => $request->contact_number,
            'degree_programe' => $request->degree_programe,
            'subject_details' => json_encode($request->subject_details), // Convert array to JSON
            'medical_details' => json_encode($request->medical_details), // Convert array to JSON
            'agree' => $request->agree,
            'medical_image' => $imagePath, // Store image path
        ]);

        return redirect()->back()->with('success', 'Medical exam submission successful!');
    }

    public function show($id)
    {
        $medi = MedicalExam::find($id);
        info($medi);
        return view('medical.view_exam', compact('medi'));
    }
}
