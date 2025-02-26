@extends('layouts.admin')

@section('title', 'Update Quarters')

@section('content')
    <div class="container">
        <h2>Edit Quartaz</h2>
        <form action="{{ route('quartaz.update', $quartaz->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Number</label>
                <input type="text" name="num" class="form-control" value="{{ $quartaz->num }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="{{ $quartaz->address }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" required>{{ $quartaz->description }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Status</label>
                <input type="text" name="status" class="form-control" value="{{ $quartaz->status }}" required>
            </div>
            {{-- <div class="mb-3"><label class="form-label">Quarters Status</label>
                <select name="status"
                    class="form-control">
                    <option value="{{ $quartaz->status }}">Selected Quarters</option>
                    <option value="{{ $quartaz->status }}">Unselected Quarters</option>
                    <option value="{{ $quartaz->status }}">Repearing Quarters</option>
                    <option value="{{ $quartaz->status }}">Need to Repair Quarters</option>
                </select>
            </div> --}}
            <br>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
            
                <a href="{{ route('quartaz') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
