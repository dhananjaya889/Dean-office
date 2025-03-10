@extends('layouts.admin')

@section('title', 'Quarters')

@section('content')
<!-- Previous Quarters Table -->
<div class="card mt-4 shadow border-0">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0"><i class="bi bi-clock-history"></i> Previous Quarters</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Registration Number</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Register Number</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($previous_quartaz as $pq)
                        <tr>
                            <td>{{ $pq->quartaz_id }}</td>
                            <td>{{ $pq->name }}</td>
                            <td>{{ $pq->email }}</td>
                            <td>{{ $pq->reg_no }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection