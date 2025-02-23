@extends('layouts.admin')

@section('title', 'View Examination Medical')

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
                            <strong>Name:</strong> {{ $medi->student_name }}
                        </div>
                        <div class="col-md-6">
                            <strong>Registration No:</strong> {{ $medi->registation_number }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Contact:</strong> {{ $medi->contact_number }}
                        </div>
                        <div class="col-md-6">
                            <strong>Degree Program:</strong> {{ $medi->degree_programe }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Academic Year:</strong> {{ $medi->year }}
                        </div>
                        <div class="col-md-6">
                            <strong>Level:</strong> {{ $medi->level }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Semester:</strong> {{ $medi->semester }}
                        </div>
                        <div class="col-md-6">
                            <strong>Medical Agreement:</strong>
                            <span class="badge {{ $medi->agree ? 'bg-success' : 'bg-danger' }}">
                                {{ $medi->agree ? 'Agreed' : 'Not Agreed' }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Status:</strong> {{ $medi->status }}
                        </div>
                        @if (Auth::user()->role == "admin" || Auth::user()->role == 'staff')
                        <div class="col-md-6">
                            <form action="{{route('medical.chenge_status_exam', $medi->id)}}" method="post">
                                @csrf
                                <strong>Change status:</strong>
                                <select name="status" id="edit_status" class="form-control">
                                    <option value="pending" {{ $medi->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $medi->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $medi->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                                <button type="submit" class="btn btn-primary mt-2 w-100">Change</button>
                            </form>
                        </div>
                        @endif
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
                                <th>Exam Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(json_decode($medi->subject_details, true) as $subject)
                            <tr>
                                <td>{{ $subject['name_of_subject'] }}</td>
                                <td>{{ $subject['subject_code'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($subject['date_and_time_exam'])->format('Y-m-d H:i A') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Medical Details -->
            <div class="card mt-4 shadow-lg border-0 rounded-lg">
                <div class="card-header bg-warning text-white text-center">
                    <h5><i class="fas fa-file-medical"></i> Medical Details</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th>Certificate No.</th>
                                <th>Covered Period</th>
                                <th>Subject Code</th>
                                <th>Date of Issue</th>
                                <th>Place of Issue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(json_decode($medi->medical_details, true) as $medical)
                            <tr>
                                <td>{{ $medical['medical_certificate_number'] }}</td>
                                <td>{{ $medical['period_of_covered'] }}</td>
                                <td>{{ $medical['subject_code'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($medical['date_of_issue'])->format('Y-m-d') }}</td>
                                <td>{{ $medical['place_of_issue'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Medical Image -->
            <div class="card mt-4 shadow-lg border-0 rounded-lg">
                <div class="card-header bg-info text-white text-center">
                    <h5><i class="fas fa-file-image"></i> Medical Certificate</h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset($medi->medical_image) }}" alt="Medical Certificate" class="img-fluid rounded" style="max-width: 80%; height: auto;">
                </div>
                <div class="card-footer text-center">
                    <a href="{{url('medical_exam')}}" class="btn btn-secondary">Back to Medical</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
