@extends('layouts.admin')

@section('title', 'Quarters Items Check List')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">All Quarters Items Check List</div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form method="GET" action="{{ route('check_list.index') }}" class="mb-3">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <label class="form-label">User Name</label>
                            <input type="text" name="name" class="form-control" value="{{ request('name') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Quarters Number</label>
                            <input type="text" name="num" class="form-control" value="{{ request('num') }}">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('check_list.index') }}" class="btn btn-secondary ms-2">Reset</a>
                        </div>
                    </div>
                </form>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Quarters Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="noticeTableBody">
                            @foreach ($check_list as $c)
                                <tr>
                                    <td>{{$c->name}}</td>
                                    <td>{{$c->num}}</td>
                                    <td><a class="btn btn-primary"
                                            href="{{ route('check_list.create', [$c->user_id, $c->qua_id] ) }}">View</a></td>
                                    
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

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Previeus Quarters Items Check List</div>
            <div class="card-body">
                
                <form method="GET" action="{{ route('check_list.index') }}" class="mb-3">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <label class="form-label">User Name</label>
                            <input type="text" name="pname" class="form-control" value="{{ request('name') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Quarters Number</label>
                            <input type="text" name="pnum" class="form-control" value="{{ request('num') }}">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('check_list.index') }}" class="btn btn-secondary ms-2">Reset</a>
                        </div>
                    </div>
                </form>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Quarters Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="noticeTableBody">
                            @foreach ($prev as $c)
                                <tr>
                                    <td>{{$c->name}}</td>
                                    <td>{{$c->num}}</td>
                                    <td><a class="btn btn-primary"
                                            href="{{ route('check_list.create', [$c->user_id, $c->qua_id] ) }}">View</a></td>
                                    
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