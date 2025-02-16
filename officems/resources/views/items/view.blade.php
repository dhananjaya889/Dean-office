@extends('layouts.admin')

@section('title', 'View Item')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0 text-center">Item Details</h3>
            </div>
            <div class="card-body text-center">
                <h4 class="text-primary">{{$items->item_id}}</h4>
                <hr>
                <div class="mb-3">
                    <strong>Item Name:</strong> {{$items->name}}
                </div>
                <div class="mb-3">
                    <strong>Description:</strong> {{$items->description}}
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('items') }}" class="btn btn-secondary">Back to Items</a>
            </div>
        </div>
    </div>
</div>

@endsection
