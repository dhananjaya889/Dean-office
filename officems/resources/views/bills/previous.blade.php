@extends('layouts.admin')

@section('title', 'Previous Bills')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Previous Bills</div>
            <div class="card-body">

                <div class="table-responsive">
                    <a href="{{ route('previous.bills.download') }}" class="btn btn-danger">Download PDF</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Bill Number</th>
                                <th>Bill Name</th>
                                <th>Bill Date</th>
                                <th>Bill Month</th>
                                <th>Bill Amount</th>
                                <th>User Name</th>
                                <th>Quartz Number</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($previousBills as $bill)
                                <tr>
                                    <td>{{ $bill->bill_id }}</td>
                                    <td>{{ $bill->name }}</td>
                                    <td>{{ $bill->date }}</td>
                                    <td>{{ $bill->month }}</td>
                                    <td>{{ $bill->amount }}</td>
                                    <td>{{ $bill->user ? $bill->user->name : 'N/A' }}</td>
                                    <td>{{ $bill->quartz ? $bill->quartz->num : 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div id="paginationLinks">
                    {{ $previousBills->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
