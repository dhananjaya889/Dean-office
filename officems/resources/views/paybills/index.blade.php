@extends('layouts.admin')

@section('title', 'Monthly bills paid for Faculty Quarters')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Paid Utility Bills</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('paybills.index') }}">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label class="form-label">Bill Name</label>
                                <select name="bill_name" class="form-control">
                                    <option value="">All</option>
                                    <option value="Electric Bill"
                                        {{ request('bill_name') == 'Electric Bill' ? 'selected' : '' }}>Electric Bill</option>
                                    <option value="Water Bill" {{ request('name') == 'Water Bill' ? 'selected' : '' }}>Water Bill</option>
                                    <option value="Telecommunication Bill"
                                        {{ request('bill_name') == 'Telecommunication Bill' ? 'selected' : '' }}>
                                        Telecommunication Bill</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">Bill Number</label>
                                <input type="text" name="bill_id" class="form-control" value="{{ request('bill_id') }}">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('paybills.index') }}" class="btn btn-secondary ms-2">Reset</a>
                            </div>
                            
                                <div class="col-md-2 d-flex align-items-end">
                                    <a href="{{ url('/paybills/create') }}" class="btn btn-info">Add Payied Bill</a>
                                </div>
                            
                            {{-- @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                                <div class="col-sm-2 d-flex align-items-end">
                                    <a href="{{ route('previous.bills') }}" class="btn btn-warning">Previous Bills</a>
                                </div>
                            @endif --}}
                        </div>
                    </form>

                    <!-- Table to Display Bills -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Bill Number</th>
                                    <th>Bill Name</th>
                                    <th>Premises ID / Inv NO</th>
                                    <th>User ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="noticeTableBody">
                                @foreach ($paybills as $pb)
                                    <tr>
                                        <td>{{ $pb->bill_id }}</td>
                                        <td>{{ $pb->bill_name}}</td>
                                        <td>{{ $pb->ref_id }}</td>
                                        <td>{{ $pb->user_id }}</td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('/paybills/' . $pb->id) }}">View</a></td>
                                        <td>
                                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                                                <form action="{{ route('paybills.destroy', $pb->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this paybill?')">
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
                        {{ $paybills->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
