@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="mb-0">User Profile</h3>
            </div>
            <div class="card-body text-center">
                <!-- Profile Picture -->
                <img src="{{ $user->profile_photo_url }}" alt="Profile Picture" class="rounded-circle border shadow-lg mb-3" width="120" height="120">

                <h4 class="text-primary mt-2">{{$user->first_name}} {{$user->last_name}}</h4>
                <span class="badge bg-success">{{ ucfirst($user->role) }}</span>
                <hr>

                <!-- User Details -->
                <div class="row text-start">
                    <div class="col-md-6 mb-3">
                        <strong>Email:</strong> {{$user->email}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Phone:</strong> {{$user->phone_number}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>WhatsApp:</strong> {{$user->whatsapp}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>NIC:</strong> {{$user->nic}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Date of Birth:</strong> {{$user->dob}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Gender:</strong> {{$user->gender}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Married:</strong> {{$user->married}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Experience:</strong> {{$user->experience}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Reg/Emp No:</strong> {{$user->reg_no}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Start Date:</strong> {{$user->start_date}}
                    </div>
                </div>

                <!-- Address Section -->
                <div class="card bg-light p-3 mt-3">
                    <h5 class="text-secondary">Address</h5>
                    <p class="mb-0">{{$user->address_l1}}, {{$user->address_l2 ?? ''}}</p>
                    <p class="mb-0">{{$user->city}}, {{$user->province}}, {{$user->postal_code}}</p>
                </div>
            </div>
            <div class="card-body text-center d-grid gap-2 col-6 mx-auto">
                <a href="{{url('/user/edit/'.$user->id)}}" type="button" class="btn btn-dark">Edit Profile</a>
            </div>

            <div class="card-footer text-center">
                
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <button type="submit" class="nav-link"><i class="bi bi-box-arrow-left"></i> Log Out</button>
                    {{-- <x-dropdown-link href="{{ route('logout') }}"
                             @click.prevent="$root.submit();" class="nav-link" style="margin-left: -10px">
                             <i class="bi bi-box-arrow-left"></i> Log Out
                    </x-dropdown-link> --}}
                </form>
                {{-- <a href="{{ route('logout') }}" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a> --}}
            </div>
        </div>
    </div>
</div>

@endsection
