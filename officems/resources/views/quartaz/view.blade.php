@extends('layouts.admin')

@section('title', 'View Quartz')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0">
        <div class="card-body">
            <h2 class="text-primary fw-bold text-center">
                <i class="bi bi-gem"></i> Quartz Details
            </h2>
            <hr class="border-primary">
            
            <div class="row">
                <div class="col-md-6">
                    <p><strong><i class="bi bi-hash"></i> Registration Number:</strong> {{ $quartaz->num }}</p>
                    <p><strong><i class="bi bi-geo-alt-fill"></i> Address:</strong> {{ $quartaz->address }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong><i class="bi bi-file-text"></i> Description:</strong> {{ $quartaz->description }}</p>
                    <p><strong><i class="bi bi-info-circle"></i> Status:</strong> <span class="badge bg-success">{{ $quartaz->status }}</span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Items Section -->
    <div class="card mt-4 shadow border-0">
        <div class="card-header bg-gradient text-white d-flex justify-content-between align-items-center" style="background: linear-gradient(to right, #4e54c8, #8f94fb);">
            <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Add Quartz Items</h5>
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                <a href="{{ url('/quartaz/quartazitem/'.$quartaz->id) }}" class="btn btn-light btn-sm">
                    <i class="bi bi-plus-lg"></i> Add Items
                </a>
            @endif
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="bi bi-123"></i> Item Number</th>
                            <th><i class="bi bi-box-seam"></i> Item Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $i)
                            <tr>
                                <td>{{ $i->item_id }}</td>
                                <td>{{ $i->name }}</td>
                                <td>
                                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                                        <form action="{{ route('quartazitem.delete', $i->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                
            </div>
        </div>
    </div>

    <!-- Add Lecture Section -->
    <div class="card mt-4 shadow border-0">
        <div class="card-header bg-gradient text-white d-flex justify-content-between align-items-center" style="background: linear-gradient(to right, #ff7eb3, #ff758c);">
            <h5 class="mb-0"><i class="bi bi-person-plus"></i> Add Lecture for Quartz</h5>
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                <a href="{{ url('/quartaz/quartazuser/'.$quartaz->id) }}" class="btn btn-light btn-sm">
                    <i class="bi bi-plus-lg"></i> Add Lecture
                </a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="bi bi-hash"></i>Name</th>
                            <th><i class="bi bi-geo-alt-fill"></i> Email</th>
                            <th><i class="bi bi-file-text"></i> contact</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($user as $user) --}}
                        @if ($user)
                        
                        
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number }}</td>
                                
                                <td>
                                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                                    <form action="{{ route('quartazuser.delete', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this lecture?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endif
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                
            </div>
        </div>
    </div>
</div>
@endsection
