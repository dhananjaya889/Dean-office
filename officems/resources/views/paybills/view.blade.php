@extends('layouts.admin')

@section('title', 'View Pay Bill Details')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0 text-center">Pay Bill Details</h3>
                </div>
                <div class="card-body">
                    <h4 class="text-center text-primary">{{ $paybills->bill_name }}</h4>
                    <hr>
                    <div class="mb-3">
                        <strong>Bill Number:</strong> {{ $paybills->bill_id }}
                    </div>
                    <div class="mb-3">
                        <strong>Bill Date:</strong> {{ $paybills->created_at }}
                    </div>
                    <div class="mb-3">
                        <strong>Bill Reference Number:</strong> {{ $paybills->ref_id }}
                    </div>
                    <div class="mb-3">
                        <strong>Bill Amount:</strong> <span class="text-success">Rs. {{ $paybills->amount }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>User ID:</strong> {{ $paybills->user_id }}
                    </div>
                    @if ($paybills->image)
                        <div class="text-center">
                            <img src="{{ asset($paybills->image) }}" alt="Bill Image" class="img-fluid rounded shadow-lg"
                                style="max-width: 100%; height: auto;">
                        </div>
                    @endif
                </div>
                <div class="card-footer text-center">
                    <a href="{{ url('paybills') }}" class="btn btn-secondary">Back to Bills</a>
                </div>
            </div>
        </div>
    </div>

@endsection
