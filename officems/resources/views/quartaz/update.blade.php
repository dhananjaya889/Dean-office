@extends('layouts.admin')

@section('title', 'Update Quarters')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">Edit Quarters</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('quartaz.update', $quartaz->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-bold">Number</label>
                                <input type="text" name="num" class="form-control" value="{{ $quartaz->num }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Address</label>
                                <input type="text" name="address" class="form-control" value="{{ $quartaz->address }}" required>
                            </div>
                            <div class="mb-3"><label class="form-label">Quarters Type</label>
                                <select name="type" class="form-control">
                                    <option value="{{ $quartaz->type }}" selected>{{ $quartaz->type }}</option>
                                    <option value="Bachelor Quarters">Bachelor Quarters</option>
                                    <option value="Family Quarters">Family Quarters</option>
                                    <option value="Guest House">Guest House</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Quarters Electric Bill No</label>
                                <input type="text" name="ebill_no" class="form-control" value="{{ $quartaz->ebill_no }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Quarters Water Bill No</label>
                                <input type="text" name="wbill_no" class="form-control" value="{{ $quartaz->wbill_no }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Monthly rent for the quarters</label>
                                <input type="text" name="rent" class="form-control" value="{{ $quartaz->rent }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" class="form-control" rows="4" required>{{ $quartaz->description }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="{{ $quartaz->status }}" selected>{{ $quartaz->status }}</option>
                                    <option value="Selected Quarters">Selected Quarters</option>
                                    <option value="Unselected Quarters">Unselected Quarters</option>
                                    <option value="Repearing Quarters">Repairing Quarters</option>
                                    <option value="Need to Repair Quarters">Need to Repair Quarters</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('quartaz') }}" class="btn btn-secondary px-4">
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
