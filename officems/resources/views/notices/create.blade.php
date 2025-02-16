@extends('layouts.admin')

@section('title', 'Create Notices')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Create Notice</div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('notices.store') }}" method="POST">
                
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Create Notice Date</label>
                        <input type="date" name="create_date" class="form-control" required>
                    
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3"><label class="form-label">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    
                    <div class="mb-3"><label class="form-label">Role</label>
                        <select name="role"
                            class="form-control">
                            <option value="admin">Admin</option>
                            <option value="lecture">Lecture</option>
                            <option value="student">Student</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Create Notice</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection