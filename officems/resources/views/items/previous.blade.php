@extends('layouts.admin')

@section('title', 'Previous Items')

@section('content')
<!-- Previous Quarters Table -->
<div class="card mt-4 shadow border-0">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0"><i class="bi bi-clock-history"></i> Previous Items</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            {{-- <a href="{{ route('previous_items.download') }}" class="btn btn-danger">Download PDF</a> --}}
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Item Add Date</th>
                        <th>Description</th>
                        <th>Quarters Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($previous_items as $pi)
                        <tr>
                            <td>{{ $pi->item_id }}</td>
                            <td>{{ $pi->name }}</td>
                            <td>{{ $pi->item_add_date }}</td>
                            <td>{{ $pi->description }}</td>
                            <td>{{ $pi->quartaz_num }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection