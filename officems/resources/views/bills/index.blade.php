@extends('layouts.admin')

@section('title', 'Utility bills in Quarters')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Utility Bills Details</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('bills.index') }}">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label class="form-label">Bill Name</label>
                                <select name="name" class="form-control">
                                    <option value="">All</option>
                                    <option value="Electric Bill"
                                        {{ request('name') == 'Electric Bill' ? 'selected' : '' }}>Electric Bill</option>
                                    <option value="Water Bill" {{ request('name') == 'Water Bill' ? 'selected' : '' }}>Water
                                        Bill</option>
                                    <option value="Telecommunication Bill"
                                        {{ request('name') == 'Telecommunication Bill' ? 'selected' : '' }}>
                                        Telecommunication Bill</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">Bill Number</label>
                                <input type="text" name="bill_id" class="form-control" value="{{ request('bill_id') }}">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('bills.index') }}" class="btn btn-secondary ms-2">Reset</a>
                            </div>
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                                <div class="col-md-2 d-flex align-items-end">
                                    <a href="{{ url('/bills/create') }}" class="btn btn-info">Add Bill</a>
                                </div>
                            @endif
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                                <div class="col-sm-2 d-flex align-items-end">
                                    <a href="{{ route('previous.bills') }}" class="btn btn-warning">Previous Bills</a>
                                </div>
                            @endif
                        </div>
                    </form>

                    <!-- Table to Display Bills -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Bill Number</th>
                                    <th>Bill Name</th>
                                    <th>Bill Date</th>
                                    <th>Bill Month</th>
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
                                        <td><a class="btn btn-primary"
                                                href="{{ url('/bills/' . $n->id . '/' . $n->name) }}">View</a></td>
                                        <td>
                                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                                                <form action="{{ route('bills.destroy', $n->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this bill?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            @else
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="paginationLinks">
                        {{ $bills->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
