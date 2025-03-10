@extends('layouts.admin')

@section('title', 'Add Pay Bill')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Add Payied Bill Details</div>
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
                <form action="{{ route('paybills.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="mb-3"><label class="form-label">Bill Name</label>
                        <select name="bill_name"
                            class="form-control">
                            <option value="">---Select Bill Type---</option>
                            <option value="Electric Bill">Electric Bill</option>
                            <option value="Water Bill">Water Bill</option>
                            <option value="Telecommunication Bill">Telecommunication Bill</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bill Number</label>
                        <input type="text" name="bill_id" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">User Name</label>
                        <input type="text" name="user_id" class="form-control" value="{{Auth::user()->name}}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="int" name="amount" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bill Reference Number</label>
                        <input type="text" name="ref_id" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bill Image</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Submit Payied Bill</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection