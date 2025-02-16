@extends('layouts.admin')

@section('title', 'View Bill Details')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0 text-center">Bill Details</h3>
            </div>
            <div class="card-body">
                <h4 class="text-center text-primary">{{$bills->name}}</h4>
                <hr>
                <div class="mb-3">
                    <strong>Bill Number:</strong> {{$bills->bill_id}}
                </div>
                <div class="mb-3">
                    <strong>Bill Date:</strong> {{$bills->date}}
                </div>
                <div class="mb-3">
                    <strong>Bill Month:</strong> {{$bills->month}}
                </div>
                <div class="mb-3">
                    <strong>Bill Amount:</strong> <span class="text-success">Rs. {{$bills->amount}}</span>
                </div>
                <div class="mb-3">
                    <strong>Used Points:</strong> {{$bills->point}}
                </div>
                @if($bills->image)
                <div class="text-center">
                    <img src="{{asset($bills->image)}}" alt="Bill Image" class="img-fluid rounded shadow-lg" style="max-width: 100%; height: auto;">
                </div>
                @endif
            </div>
            <div class="card-footer text-center">
                <a href="{{url('bills')}}" class="btn btn-secondary">Back to Bills</a>
            </div>
        </div>
    </div>
</div>

@endsection
