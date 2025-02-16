@extends('layouts.admin')

@section('title', 'View Medical for lecture')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <!-- Student Information Card -->
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4><i class="fas fa-user-graduate"></i> Student Information</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Name:</strong> {{ $medi->st_name }}
                        </div>
                        <div class="col-md-6">
                            <strong>Register No:</strong> {{ $medi->register_number }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Address:</strong> {{ $medi->st_address }}
                        </div>
                        <div class="col-md-6">
                            <strong>Contact:</strong> {{ $medi->st_contact }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Academic Year:</strong> {{ $medi->academic_year }}
                        </div>
                        <div class="col-md-6">
                            <strong>Level:</strong> {{ $medi->level }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Semester:</strong> {{ $medi->semester_year }}
                        </div>
                        <div class="col-md-6">
                            <strong>Degree Program:</strong> {{ $medi->degree_programe }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subject Details -->
            <div class="card mt-4 shadow-lg border-0 rounded-lg">
                <div class="card-header bg-success text-white text-center">
                    <h5><i class="fas fa-book"></i> Subject Details</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th>Subject Name</th>
                                <th>Code</th>
                                <th>Date</th>
                                <th>Place of Issue</th>
                                <th>Medical Certificate No.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(json_decode($medi->subject_details, true) as $subject)
                            <tr>
                                <td>{{ $subject['name_of_subject'] }}</td>
                                <td>{{ $subject['subject_code'] }}</td>
                                <td>{{ $subject['date'] }}</td>
                                <td>{{ $subject['pace_of_issue'] }}</td>
                                <td>{{ $subject['medical_cetificate_number'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Medical Image -->
            <div class="card mt-4 shadow-lg border-0 rounded-lg">
                <div class="card-header bg-warning text-white text-center">
                    <h5><i class="fas fa-file-medical"></i> Medical Certificate</h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset($medi->medical_image) }}" alt="Medical Certificate" class="img-fluid rounded" style="max-width: 80%; height: auto;">
                </div>
                <div class="card-footer text-center">
                    <a href="{{url('medical_lec')}}" class="btn btn-secondary">Back to Medical</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
