@extends('layouts.admin')

@section('title', 'Add Medical')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Submit Medical for Classes</div>
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
                    <form action="{{ route('medical.store_lec') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Student Name</label>
                            <input type="text" name="student_name" class="form-control" value="{{ auth()->user()->name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" value="{{ auth()->user()->phone_number }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Register Number</label>
                            <input type="text" name="registration_number" class="form-control" value="{{ auth()->user()->reg_no }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Academic Year</label>
                            <input type="text" name="academic_year" class="form-control" required>
                        </div>
                        <div class="mb-3"><label class="form-label">Level</label>
                            <select name="level"
                                class="form-control" required>
                                <option value="">---Select Level---</option>
                                <option value="level">Level 01</option>
                                <option value="level">Level 02</option>
                                <option value="level">Level 03</option>
                                <option value="level">Level 04</option>
                            </select>
                        </div>
                        <div class="mb-3"><label class="form-label">Semester</label>
                            <select name="semester"
                                class="form-control" required>
                                <option value="">---Select Semester---</option>
                                <option value="semester">Semester 01</option>
                                <option value="semester">Semester 02</option>
                            </select>
                        </div>
                        <div class="mb-3"><label class="form-label">Degree Program</label>
                            <select name="degree_programe"
                                class="form-control" required>
                                <option value="">---Select Program---</option>
                                <option value="ict">ICT</option>
                                <option value="et">ET</option>
                                <option value="bst">BST</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Medical Certificate Image</label>
                            <input type="file" name="medical_image" class="form-control" required>
                        </div>

                        <div id="subjects-container">
                            <label class="form-label">Subject Details</label>
                            <div class="subject-group mb-2 mt-2">
                                <input type="text" name="subject_details[0][name_of_subject]" class="form-control mb-2"
                                    placeholder="Name of Subject" required>
                                <input type="text" name="subject_details[0][subject_code]" class="form-control mb-2"
                                    placeholder="Subject Code" required>
                                <input type="date" name="subject_details[0][date]" class="form-control mb-2" required>
                                <input type="text" name="subject_details[0][pace_of_issue]" class="form-control mb-2"
                                    placeholder="Place of Issue Medical Certificate" required>
                                <input type="text" name="subject_details[0][medical_cetificate_number]"
                                    class="form-control mb-2" placeholder="Medical Certificate Number" required>
                                    <hr>
                            </div>
                        </div>

                        <button type="button" id="add-subject" class="btn btn-secondary">Add Another Subject</button>
                        <button type="submit" class="btn btn-success w-100 mt-3">Submit</button>
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
            <input type="date" name="subject_details[\${subjectCount}][date]" class="form-control mb-2" required>
            <input type="text" name="subject_details[\${subjectCount}][pace_of_issue]" class="form-control mb-2" placeholder="Place of Issue Medical Certificate" required>
            <input type="text" name="subject_details[\${subjectCount}][medical_cetificate_number]" class="form-control mb-2" placeholder="Medical Certificate Number" required>
            <hr>
        `;
            container.appendChild(newSubject);
            subjectCount++;
        });
    </script>
@endsection
