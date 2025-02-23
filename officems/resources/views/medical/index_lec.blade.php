@extends('layouts.admin')

@section('title', 'Classes & Practicals Medicals')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Medicals for Classes & Practicals</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-sm-9">
                        </div>
                        <div class="col-sm-3">
                            <a href="{{ url('medical/create_lec') }}" class="btn btn-info">Submit medicals for Classes</a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Contact</th>
                                    <th>Register Number</th>
                                    <th>Academic Year</th>
                                    <th>Level</th>
                                    <th>Semester</th>
                                    <th>Degree Program</th>
                                    <th>Medical Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody id="noticeTableBody">
                                @foreach ($medicals as $medical)
                                    <tr>
                                        <td>{{ $medical->id }}</td>
                                        <td>{{ $medical->st_name }}</td>
                                        <td>{{ $medical->st_contact }}</td>
                                        <td>{{ $medical->register_number }}</td>
                                        <td>{{ $medical->academic_year }}</td>
                                        <td>{{ $medical->level }}</td>
                                        <td>{{ $medical->semester_year }}</td>
                                        <td>{{ $medical->degree_programe }}</td>
                                        <td>
                                            @if ($medical->medical_image)
                                                <img src="{{asset($medical->medical_image)}}"
                                                    alt="Medical Image" width="50">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $medical->status }}</td>
                                        <td>
                                            <a href="{{ url('medical/view_lec/'. $medical->id) }}"
                                                class="btn btn-primary btn-sm">View</a>

                                            <form action="" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="paginationLinks">
                        {{ $medicals->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
