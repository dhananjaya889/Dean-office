@extends('layouts.admin')

@section('title', 'View Quarters Items Check List')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">Add Check List Items</div>
                <div class="card-body">
                    <form method="GET" action="" class="mb-3">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label class="form-label">Items Name</label>
                                <input type="text" name="" class="form-control" value="">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Items Quantity</label>
                                <input type="text" name="" class="form-control" value="">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Add check list</button>
                            </div>
                            <div class="col-md-2 d-flex align-items-end"></div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#item">Add Items</button>

                                <!-- The Modal -->
                                <div class="modal" id="item">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add New Item</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <input type="text" name="item_name" class="form-control"
                                                    placeholder="Enter the New Checklist Item" required>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success"
                                                    >Save</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">Quarters Check List Items</div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">Other Damage or Failure Note by Here</div>
                <div class="card-body">
                    <form method="GET" action="" class="mb-3">
                        <div class="row">
                            <div class="col-sm-9"></div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#note">Add Notes</button>

                                    <!-- The Modal -->
                                    <div class="modal" id="note">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Other Damage or Failure Note by Here</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <textarea name="note" class="form-control" placeholder="Other Damage or Failure Note by Here" required></textarea>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success"
                                                        data-bs-dismiss="modal">Save</button>
                                                        <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
