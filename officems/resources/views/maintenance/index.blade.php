@extends('layouts.admin')

@section('title', 'Maintenance')

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Maintenance</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('maintenance') }}" method="get">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label class="form-label">User ID</label>
                                <input type="text" name="user_id" class="form-control" value="{{ request('user_id') }}">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Item ID</label>
                                <input type="text" name="item_id" class="form-control" value="{{ request('item_id') }}">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Admin Approve</label>
                                <select name="admin_approve" class="form-control">
                                    <option value="">--- Select one ---</option>
                                    <option value="open">Open</option>
                                    <option value="todo">ToDo</option>
                                    <option value="processing">Processing</option>
                                    <option value="done">Done</option>
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('maintenance') }}" class="btn btn-secondary ms-2">Reset</a>
                            </div>

                            <div class="col-md-2 d-flex align-items-end">
                                <a href="{{ url('/maintenance/create') }}" class="btn btn-info">Add Inquery</a>
                            </div>
                            {{-- @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                    <div class="col-sm-2 d-flex align-items-end">
                        <a href="" class="btn btn-secondary">Previous Items</a>
                    </div>
                    @endif --}}
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>user_id</th>
                                    <th>item_id</th>
                                    <th>admin_approve</th>
                                    <th>mainten_status</th>
                                    <th>user_status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="quartazTableBody">
                                @foreach ($maintens as $m)
                                    <tr>
                                        <td>{{ $m->user_id }}</td>
                                        <td>{{ $m->item_id }}</td>
                                        <td>{{ $m->admin_approve }}</td>
                                        <td>{{ $m->mainten_status }}</td>
                                        <td>{{ $m->user_status }}</td>
                                        <td><a href="{{ route('maintenance.edit', $m->id) }}"
                                                class="btn btn-primary">Edit</a></td>
                                        <td><a href="{{ url('/maintenance/' . $m->id) }}" class="btn btn-primary">View</a>
                                        </td>
                                        <td>
                                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                                                <form action="{{ route('maintenance.destroy', $m->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this maintenance?')">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="_method" value="DELETE">
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

                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
