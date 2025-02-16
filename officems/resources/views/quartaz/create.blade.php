@extends('layouts.admin')

@section('title', 'Create Quartaz')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Add Quartz</div>
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
                <form action="{{ route('quartaz.store') }}" method="POST">
                
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Quartz Number</label>
                        <input type="text" name="num" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quartz Address</label>
                        <input type="text" name="address" class="form-control" required>
                    </div>
                    <div class="mb-3"><label class="form-label">About Quartz Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3"><label class="form-label">Quartz Status</label>
                        <select name="status"
                            class="form-control">
                            <option value="selected">Selected Quartz</option>
                            <option value="unselected">Unselected Quartz</option>
                            <option value="repearing">Repearing Quartz</option>
                            <option value="need to repair">Need to Repair Quartz</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Add Quartz</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection