@extends('layouts.admin')

@section('title', 'Create Medical')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Submit Medical for lectures</div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('medical.store_exam') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Student Name</label>
                            <input type="text" name="student_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Year</label>
                            <input type="text" name="year" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Level</label>
                            <input type="text" name="level" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Semester</label>
                            <input type="text" name="semester" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Registration Number</label>
                            <input type="text" name="registation_number" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Degree Program</label>
                            <input type="text" name="degree_programe" class="form-control" required>
                        </div>

                        <div id="subjects-container">
                            <label class="form-label">Subject Details</label>
                            <div class="subject-group mb-2 mt-2">
                                <input type="text" name="subject_details[0][name_of_subject]" class="form-control mb-2"
                                    placeholder="Name of Subject" required>
                                <input type="text" name="subject_details[0][subject_code]" class="form-control mb-2"
                                    placeholder="Subject Code" required>
                                <input type="datetime-local" name="subject_details[0][date_and_time_exam]"
                                    class="form-control mb-2" required>

                                <hr>
                            </div>
                        </div>
                        <button type="button" id="add-subject" class="btn btn-secondary mb-3">Add Another Subject</button>

                        <div id="medical-details-container">
                            <label class="form-label">Medical Details</label>
                            <div class="medical-group mt-2 mb-2">
                                <input type="text" name="medical_details[0][medical_certificate_number]"
                                    class="form-control mb-2" placeholder="Medical Certificate Number" required>
                                <input type="text" name="medical_details[0][period_of_covered]" class="form-control mb-2"
                                    placeholder="Period of Covered" required>
                                <input type="text" name="medical_details[0][subject_code]" class="form-control mb-2"
                                    placeholder="Subject Code" required>
                                <input type="date" name="medical_details[0][date_of_issue]" class="form-control mb-2"
                                    required>
                                <input type="text" name="medical_details[0][place_of_issue]" class="form-control mb-2"
                                    placeholder="Place of Issue" required>
                                <hr>
                            </div>
                        </div>
                        <button type="button" id="add-medical" class="btn btn-secondary mb-3">Add Another Medical
                            Detail</button>

                        <div class="mb-3">
                            <label class="form-label">Upload Medical Image</label>
                            <input type="file" name="medical_image" class="form-control" accept="image/*" required>
                        </div>

                        <div class="mb-3">
                            <input type="checkbox" name="agree" value="1" required>
                            <label class="form-label">If you click this, you certify the above information is
                                correct.</label>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('additinal-script')
    <script>
        let subjectCount = 1;
        document.getElementById('add-subject').addEventListener('click', function() {
            let container = document.getElementById('subjects-container');
            let newSubject = document.createElement('div');
            newSubject.classList.add('subject-group');
            newSubject.innerHTML = `
            <input type="text" name="subject_details[\${subjectCount}][name_of_subject]" class="form-control mb-2" placeholder="Name of Subject" required>
            <input type="text" name="subject_details[\${subjectCount}][subject_code]" class="form-control mb-2" placeholder="Subject Code" required>
            <input type="datetime-local" name="subject_details[\${subjectCount}][date_and_time_exam]" class="form-control mb-2" required>
            <hr>
        `;
            container.appendChild(newSubject);
            subjectCount++;
        });

        let medicalCount = 1;
        document.getElementById('add-medical').addEventListener('click', function() {
            let container = document.getElementById('medical-details-container');
            let newMedical = document.createElement('div');
            newMedical.classList.add('medical-group');
            newMedical.innerHTML = `
            <input type="text" name="medical_details[\${medicalCount}][medical_certificate_number]" class="form-control mb-2" placeholder="Medical Certificate Number" required>
            <input type="text" name="medical_details[\${medicalCount}][period_of_covered]" class="form-control mb-2" placeholder="Period of Covered" required>
            <input type="text" name="medical_details[\${medicalCount}][subject_code]" class="form-control mb-2" placeholder="Subject Code" required>
            <input type="date" name="medical_details[\${medicalCount}][date_of_issue]" class="form-control mb-2" required>
            <input type="text" name="medical_details[\${medicalCount}][place_of_issue]" class="form-control mb-2" placeholder="Place of Issue" required>
            <hr>
        `;
            container.appendChild(newMedical);
            medicalCount++;
        });
    </script>
@endsection
