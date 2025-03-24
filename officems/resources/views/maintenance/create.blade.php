@extends('layouts.admin')

@section('title', 'Adding the Complaint for Maintenance')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Add Complaint</div>
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
                <form action="{{ route('maintenance.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                
                    <div class="mb-3">
                        <label class="form-label">User</label>
                        <input type="text" name="user_id" class="form-control" value="{{ old('user_id', Auth::user()->reg_no) }}" required>
                    </div>
                
                    <div class="mb-3">
                        <label class="form-label">Item ID (optional)</label>
                        <select name="item_id" id="" class="form-control">
                            <option value="">--- select one ---</option>
                            @foreach ($items as $i)
                                <option value="{{$i->id}}">{{$i->item_id}} - {{$i->name}}</option>
                            @endforeach
                            
                        </select>
                        
                    </div>
                
                    <div class="mb-3">
                        <label class="form-label">What needs to be repaired?</label>
                        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                    </div>
                
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>
                
                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                        <div class="mb-3">
                            <label class="form-label">Admin Approved</label>
                            <select name="admin_approve" class="form-control">
                                <option value="">--- Select one ---</option>
                                <option value="open" {{ old('admin_approve') == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="todo" {{ old('admin_approve') == 'todo' ? 'selected' : '' }}>ToDo</option>
                                <option value="done" {{ old('admin_approve') == 'done' ? 'selected' : '' }}>Done</option>
                            </select>
                        </div>
                    @endif
                
                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff' || Auth::user()->role == 'maintainer')
                        <div class="mb-3">
                            <label class="form-label">Maintenance Status</label>
                            <select name="mainten_status" class="form-control">
                                <option value="">--- Select one ---</option>
                                <option value="open" {{ old('mainten_status') == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="done" {{ old('mainten_status') == 'done' ? 'selected' : '' }}>Done</option>
                            </select>
                        </div>
                
                        <div class="mb-3">
                            <label class="form-label">Maintenance Description</label>
                            <textarea name="maintenance_description" class="form-control">{{ old('maintenance_description') }}</textarea>
                        </div>
                    @endif
                
                    <div class="mb-3">
                        <label class="form-label">User Status</label>
                        <select name="user_status" class="form-control">
                            <option value="">--- Select one ---</option>
                            <option value="open" {{ old('user_status') == 'open' ? 'selected' : '' }}>Open</option>
                            <option value="done" {{ old('user_status') == 'done' ? 'selected' : '' }}>Done</option>
                        </select>
                    </div>
                
                    <button type="submit" class="btn btn-success w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection