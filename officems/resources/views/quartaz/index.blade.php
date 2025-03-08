@extends('layouts.admin')

@section('title', 'Quarters')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Quarters</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="row">
                        {{-- <div class="col-sm-6">
                            <input type="text" id="search" class="form-control mb-3" placeholder="Search quartaz...">
                        </div> --}}
                        <div class="col-sm-6"></div>
                        <div class="col-sm-3">
                            <a href="{{ url('/quartaz/create') }}" class="btn btn-info">Add Quarters</a>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{ route('previous_quartaz.index') }}" class="btn btn-warning">
                                View Previous Quartaz
                            </a>
                        </div>

                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Quarters Number</th>
                                    <th>Quarters Address</th>
                                    <th>Quarters Description</th>
                                    <th>Quarters Status</th>
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
                                        <td><a href="{{ route('quartaz.edit', $n->id) }}" class="btn btn-primary">Edit</a>
                                        </td>
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
                    <div id="paginationLinks">
                        {{ $quartaz->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
