@extends('layouts.admin')

@section('title', 'View Notice')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0 text-center">Notice Details</h3>
            </div>
            <div class="card-body">
                <h4 class="text-primary text-center">{{$notice->title}}</h4>
                <hr>
                <div class="mb-3">
                    <strong>Date:</strong> {{$notice->create_date}}
                </div>
                <div class="mb-3">
                    <strong>Role:</strong> {{$notice->role}}
                </div>
                <div class="mb-3">
                    <strong>Description:</strong> {{$notice->description}}
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('notices') }}" class="btn btn-secondary">Back to Notices</a>
            </div>
        </div>
    </div>
</div>

@endsection
