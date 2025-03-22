@extends('layouts.admin')

@section('title', 'Adding Items to Quarters')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Add Items</div>
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
                <form action="{{ route('items.store') }}" method="POST">
                
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Item Number</label>
                        <input type="text" name="item_id" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Item Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3"><label class="form-label">About item Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Add Item</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection