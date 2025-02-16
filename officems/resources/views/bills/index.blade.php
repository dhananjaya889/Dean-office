@extends('layouts.admin')

@section('title', 'Utility Bills')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Utility Bills</div>
            <div class="card-body">
                @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                <div class="row">
                    <div class="col-sm-9"></div>
                    <div class="col-sm-3">
                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                            <a href="{{url('/bills/create')}}" class="btn btn-info">Add Bill</a>
                        @endif
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Bill Number</th>
                                <th>Bill Name</th>
                                <th>Bill Date</th>
                                <th>Bill Month</th>
                                <th>Bill Amount</th>
                                <th>Used Point</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="noticeTableBody">
                            @foreach ($bills as $n)
                                <tr>
                                    <td>{{ $n->bill_id }}</td>
                                    <td>{{ $n->name }}</td>
                                    <td>{{ $n->date }}</td>
                                    <td>{{ $n->month }}</td>
                                    <td>{{ $n->amount }}</td>
                                    <td>{{ $n->point }}</td>
                                    <td><a class="btn btn-primary" href="{{url('/bills/'.$n->id.'/'.$n->name)}}">View</a></td>
                                    <td>
                                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                                        <form action="{{route('bills.destroy', $n->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this bill?')">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        @else
                                        <button type="button" class="btn btn-danger" disabled>Delete</button>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="paginationLinks"></div>

            </div>
        </div>
    </div>
</div>

@endsection
