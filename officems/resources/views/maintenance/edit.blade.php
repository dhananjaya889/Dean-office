@extends('layouts.admin')

@section('title', 'Update the Complaint for Maintenance')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Update Complaint</div>
            <div class="card-body">
               
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('maintenance.update', $m->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">User</label>
                        <input type="text" name="user_id" class="form-control" value="{{$m->user_id}}" required>
                    </div>
                
                    <div class="mb-3">
                        <label class="form-label">Item ID (optional)</label>
                        <select name="item_id" id="" class="form-control">
                            <option value="">--- select one ---</option>
                            @foreach ($items as $i)
                                <option {{ $m->item_id == $m->item_id ? 'selected' : '' }} value="{{$i->id}}">{{$i->item_id}} - {{$i->name}}</option>
                            @endforeach
                            
                        </select>
                        
                    </div>
                
                    <div class="mb-3">
                        <label class="form-label">About what to maintain</label>
                        <textarea name="description" class="form-control">{{ $m->description }}</textarea>
                    </div>
                
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <img src="{{asset($m->image)}}" alt="" width="100px;">
                        <input type="file" name="image" class="form-control">
                    </div>
                
                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                        <div class="mb-3">
                            <label class="form-label">Admin Approved</label>
                            <select name="admin_approve" class="form-control">
                                <option value="">--- Select one ---</option>
                                <option value="open" {{ $m->admin_approve == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="todo" {{ $m->admin_approve == 'todo' ? 'selected' : '' }}>ToDo</option>
                                <option value="done" {{ $m->admin_approve == 'done' ? 'selected' : '' }}>Done</option>
                            </select>
                        </div>
                    @endif
                
                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff' || Auth::user()->role == 'maintenance')
                        <div class="mb-3">
                            <label class="form-label">Maintenance Status</label>
                            <select name="mainten_status" class="form-control">
                                <option value="">--- Select one ---</option>
                                <option value="open" {{ $m->mainten_status == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="done" {{ $m->mainten_status == 'done' ? 'selected' : '' }}>Done</option>
                            </select>
                        </div>
                
                        <div class="mb-3">
                            <label class="form-label">Maintenance Description</label>
                            <textarea name="maintenance_description" class="form-control">{{ $m->maintenance_description }}</textarea>
                        </div>
                    @endif
                    @if (Auth::user()->role != 'maintenance')
                    <div class="mb-3">
                        <label class="form-label">User Status</label>
                        <select name="user_status" class="form-control">
                            <option value="">--- Select one ---</option>
                            <option value="open" {{ $m->user_status == 'open' ? 'selected' : '' }}>Open</option>
                            <option value="done" {{ $m->user_status == 'done' ? 'selected' : '' }}>Done</option>
                        </select>
                    </div>
                    @endif
                    
                
                    <button type="submit" class="btn btn-success w-100">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection