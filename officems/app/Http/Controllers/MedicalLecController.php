<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalLec;
use Illuminate\Support\Facades\Auth;

class MedicalLecController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff') {
            $medicals = MedicalLec::paginate(10);
        }else{
            $medicals = MedicalLec::where('register_number', Auth::user()->reg_no)->get();
        }
        
        return view('medical.index_lec', compact('medicals'));
    }

    public function create()
    {
        return view('medical.create_lec');
    }

    public function store(Request $request)
    {
        $request->validate([
            'st_name' => 'required|string|max:255',
            'st_address' => 'required|string|max:255',
            'st_contact' => 'required|string|max:255',
            'register_number' => 'required|string|max:255',
            'academic_year' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'semester_year' => 'required|string|max:255',
            'degree_programe' => 'required|string|max:255',
            'subject_details' => 'required|array',
            'subject_details.*.name_of_subject' => 'required|string',
            'subject_details.*.subject_code' => 'required|string',
            'subject_details.*.date' => 'required|date',
            'subject_details.*.pace_of_issue' => 'required|string',
            'subject_details.*.medical_cetificate_number' => 'required|string',
            'medical_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('medical_image')) {
            $image = $request->file('medical_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/lec_medical'), $imageName);

            $imagePath = 'uploads/lec_medical/'.$imageName;
        }

        MedicalLec::create([
            'st_name' => $request->st_name,
            'st_address' => $request->st_address,
            'st_contact' => $request->st_contact,
            'register_number' => $request->register_number,
            'academic_year' => $request->academic_year,
            'level' => $request->level,
            'semester_year' => $request->semester_year,
            'degree_programe' => $request->degree_programe,
            'subject_details' => json_encode($request->subject_details),
            'medical_image' => $imagePath,
        ]);

        return redirect()->route('medical_lec')->with('success', 'Medical record added successfully!');
    }

    public function show($id)
    {
        $medi = MedicalLec::find($id);
        info($medi);
        return view('medical.view_lec', compact('medi'));
    }
}
