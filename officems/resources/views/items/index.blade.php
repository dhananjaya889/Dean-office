@extends('layouts.admin')

@section('title', 'Quarters Items')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Items</div>
            <div class="card-body">
                @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                <div class="row">
                    <div class="col-sm-9"></div>
                    <div class="col-sm-3">
                        <a href="{{url('/items/create')}}" class="btn btn-info">Add Items</a>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Item Name</th>
                                <th>Item Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody id="noticeTableBody">
                            @foreach ($items as $n)
                                <tr>
                                    <td>{{ $n->item_id }}</td>
                                    <td>{{ $n->name }}</td>
                                    <td>{{ $n->description }}</td>
                                    <td><a class="btn btn-primary" href="{{url('/items/'.$n->id.'/'.$n->name)}}">View</a></td>
                                    <td>
                                        <form action="{{route('items.destroy', $n->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')">
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
                    {{$items->links()}}
                </div>

            </div>
        </div>
    </div>
</div>

@endsection