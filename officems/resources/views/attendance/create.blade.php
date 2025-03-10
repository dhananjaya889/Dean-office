@extends('layouts.admin')

@section('title', 'Add Attendance')

@section('content')

<div class="container">
    <h1>Upload Attendance CSV</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('attendance.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Month (mm/yyyy) -->
        <div class="mb-3">
            <label for="month" class="form-label">Month (dd/mm/yyyy)</label>
            <input type="text" class="form-control" id="month" name="month" placeholder="05/02/2025" required>
        </div>

        <!-- User Type -->
        <div class="mb-3">
            <label for="user_type" class="form-label">User Type</label>
            <select name="user_type" id="user_type" class="form-select" required>
                <option value="">-- Select --</option>
                <option value="lectures">Lectures</option>
                <option value="demostrators">Demostrators</option>
            </select>
        </div>

        <!-- CSV File -->
        <div class="mb-3">
            <label for="csv_file" class="form-label">CSV File</label>
            <input type="file" class="form-control" id="csv_file" name="csv_file" required>
        </div>

        <button type="submit" class="btn btn-primary">Upload CSV</button>
    </form>
</div>

@endsection
