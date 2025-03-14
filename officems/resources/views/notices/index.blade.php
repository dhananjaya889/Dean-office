@extends('layouts.admin')

@section('title', 'Notices')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Notices</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                        <a href="{{url('/notices/create')}}" class="btn btn-info">Add New Notice</a>
                        @endif
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Create Date</th>
                                <th>Title</th>
                                <th>Roles</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody id="noticeTableBody">
                            @foreach ($nortices as $n)
                                <tr>
                                    <td>{{ $n->create_date }}</td>
                                    <td>{{ $n->title }}</td>
                                    <td>{{ $n->role }}</td>
                                    
                                    <td><a class="btn btn-primary" href="{{url('/nortice/'.$n->id.'/'.$n->title)}}">View</a></td>
                                    <td>
                                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                                        <form action="{{route('notices.destroy', $n->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this notice?')">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>

                                        @else
                                        <button type="submit" class="btn btn-danger" disabled>Delete</button>
                                        @endif
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="paginationLinks">
                    {{ $nortices->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

