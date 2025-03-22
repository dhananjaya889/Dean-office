@extends('layouts.admin')

@section('title', 'Create Quarters')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Add Quarters</div>
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
                    <form action="{{ route('quartaz.store') }}" method="POST">

                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Quarters Number</label>
                            <input type="text" name="num" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Quarters Address</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>
                        <div class="mb-3"><label class="form-label">Quarters Type</label>
                            <select name="type" class="form-control">
                                <option value=""><--- Selecte ---> </option>
                                <option value="Bachelor Quarters">Bachelor Quarters</option>
                                <option value="Family Quarters">Family Quarters</option>
                                <option value="Guest House">Guest House</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Quarters Electric Bill No</label>
                            <input type="text" name="ebill_no" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Quarters Water Bill No</label>
                            <input type="text" name="wbill_no" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Monthly rent for the quarters</label>
                            <input type="text" name="rent" class="form-control" required>
                        </div>
                        <div class="mb-3"><label class="form-label">About Quarters Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3"><label class="form-label">Quarters Status</label>
                            <select name="status" class="form-control">
                                <option value=""><--- Selecte ---> </option>
                                <option value="Selected Quarters">Selected Quarters</option>
                                <option value="Unselected Quarters">Unselected Quarters</option>
                                <option value="Repearing Quarters">Repairing Quarters</option>
                                <option value="Need to Repair Quarters">Need to Repair Quarters</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Add Quarters</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
