@extends('layouts.admin')

@section('title', 'Quarters in Faculty')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Quarters</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="GET" action="{{ route('quartaz') }}" class="mb-3">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label class="form-label">Quarters Number</label>
                                <input type="text" name="num" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Quarters Status</label>
                                <select name="status" class="form-control">
                                    <option value=""> --- Status --- </option>
                                    <option value="Selected Quarters">Selected Quarters</option>
                                    <option value="Unselected Quarters">Unselected Quarters</option>
                                    <option value="Repearing Quarters">Repairing Quarters</option>
                                    <option value="Need to Repair Quarters">Need to Repair Quarters</option>
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('quartaz') }}" class="btn btn-secondary ms-2">Reset</a>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <a href="{{ url('/quartaz/create') }}" class="btn btn-info">Add Quarters</a>
                            </div>
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                                <div class="col-sm-2 d-flex align-items-end">
                                    <a href="{{ route('previous_quartaz.index') }}" class="btn btn-warning">
                                        Previous Quartaz
                                    </a>
                                </div>
                            @endif
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Quarters Number</th>
                                    <th>Quarters Address</th>
                                    <th>Quarters Status</th>
                                </tr>
                            </thead>

                            <tbody id="quartazTableBody">
                                @foreach ($quartaz as $n)
                                    <tr>
                                        <td>{{ $n->num }}</td>
                                        <td>{{ $n->address }}</td>
                                        <td>{{ $n->status }}</td>
                                        <td><a class="btn btn-primary" href="{{ url('/quartaz/' . $n->id) }}">View</a></td>
                                        <td><a href="{{ route('quartaz.edit', $n->id) }}" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('quartaz.destroy', $n->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this quartaz?')">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="paginationLinks">
                        {{ $quartaz->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
