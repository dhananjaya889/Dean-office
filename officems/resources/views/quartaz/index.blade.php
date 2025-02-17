@extends('layouts.admin')

@section('title', 'Quartz')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Quartz</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" id="search" class="form-control mb-3" placeholder="Search quartaz...">
                        </div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3">
                            <a href="{{ url('/quartaz/create') }}" class="btn btn-info">Add Quartz</a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Quartaz Number</th>
                                    <th>Quartaz Address</th>
                                    <th>Quartaz Description</th>
                                    <th>Quartaz Status</th>
                                </tr>
                            </thead>

                            <tbody id="quartazTableBody">
                                @foreach ($quartaz as $n)
                                    <tr>
                                        <td>{{ $n->num }}</td>
                                        <td>{{ $n->address }}</td>
                                        <td>{{ $n->description }}</td>
                                        <td>{{ $n->status }}</td>
                                        <td><a class="btn btn-primary" href="{{ url('/quartaz/' . $n->id) }}">View</a></td>
                                        <td>
                                            <form action="{{ route('quartaz.destroy', $n->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this quartaz?')">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
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
