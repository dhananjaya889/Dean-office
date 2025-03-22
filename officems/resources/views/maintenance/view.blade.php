@extends('layouts.admin')

@section('title', 'View Maintenance Requests')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0 text-center">Maintenance Requests Details</h3>
            </div>
            <div class="card-body text-center">
                <h4 class="text-primary">{{$maintenances->user_id}}</h4>
                <hr>
                <div class="mb-3">
                    <strong>Item Number:</strong> {{$maintenances->item_id}}
                </div>
                <div class="mb-3">
                    <strong>Description:</strong> {{$maintenances->description}}
                </div>
                <div class="mb-3">
                    <strong>Admin Approve:</strong> {{$maintenances->admin_approve}}
                </div>
                <div class="mb-3">
                    <strong>Maintenance Status:</strong> {{$maintenances->mainten_status}}
                </div>
                <div class="mb-3">
                    <strong>Maintenance Description:</strong> {{$maintenances->maintenance_description}}
                </div>
                <div class="mb-3">
                    <strong>User Status:</strong> {{$maintenances->user_status}}
                </div>
                <div class="card mt-4 shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-info text-white text-center">
                        <h5><i class="fas fa-file-image"></i> Maintenance Image</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset($maintenances->image) }}" alt="Maintenance Image" class="img-fluid rounded" style="max-width: 80%; height: auto;">
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('maintenance') }}" class="btn btn-secondary">Back to Maintenance</a>
            </div>
        </div>
    </div>
</div>

@endsection
