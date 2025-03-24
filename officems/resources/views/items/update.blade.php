@extends('layouts.admin')

@section('title', 'Update Items to Quarters')

@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">Edit Item</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('items.update', $items->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Item Number</label>
                                <input type="text" name="item_id" class="form-control" value="{{ $items->item_id }}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Item Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $items->name }}"
                                    required>
                            </div>
                            <div class="mb-3"><label class="form-label">About item Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ $items->description }}</textarea>
                            </div>


                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('items') }}" class="btn btn-secondary px-4">
                                    <i class="fas fa-arrow-left"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-check-circle"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
