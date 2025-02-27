@extends('layouts.admin')

@section('title', 'Attendance')

@section('content')

<div class="container">
    <h1>Attendance Records</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filter Form -->
    <form action="{{ route('attendance.index') }}" method="GET" class="row g-3 mb-3">
        <!-- Month -->
        <div class="col-auto">
            <label for="month" class="visually-hidden">Month</label>
            <select name="month" id="month" class="form-select">
                <option value="">All Months</option>
                @foreach($months as $m)
                    <option value="{{ $m }}" {{ (request('month') == $m) ? 'selected' : '' }}>
                        {{ $m }}
                    </option>
                @endforeach
            </select>
        </div>
        <!-- User Type -->
        <div class="col-auto">
            <label for="user_type" class="visually-hidden">User Type</label>
            <select name="user_type" id="user_type" class="form-select">
                <option value="">All Types</option>
                <option value="lectures" {{ (request('user_type') == 'lectures') ? 'selected' : '' }}>Lectures</option>
                <option value="demostrators" {{ (request('user_type') == 'demostrators') ? 'selected' : '' }}>Demostrators</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    <!-- Download Button -->
    <div class="mb-3">
        <a href="{{ route('attendance.download', ['month' => request('month'), 'user_type' => request('user_type')]) }}"
           class="btn btn-success">
            Download CSV
        </a>
    </div>

    <!-- Attendance Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Emp No</th>
                <th>Name</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Month</th>
                <th>User Type</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->id }}</td>
                    <td>{{ $attendance->emp_no }}</td>
                    <td>{{ $attendance->name }}</td>
                    <td>{{ $attendance->present }}</td>
                    <td>{{ $attendance->absent }}</td>
                    <td>{{ $attendance->month }}</td>
                    <td>{{ $attendance->user_type }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No attendance data found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div id="paginationLinks">
    {{ $attendances->links() }}
</div>

@endsection
