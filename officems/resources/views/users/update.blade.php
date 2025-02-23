@extends('layouts.admin')

@section('title', 'Update Users')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Update User</div>
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
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3"><label class="form-label">First Name</label>
                        <input type="text"
                            name="first_name" class="form-control" value="{{$user->first_name}}" required>
                    </div>

                    <div class="mb-3"><label class="form-label">Last Name</label>
                        <input type="text"
                            name="last_name" class="form-control" value="{{$user->last_name}}" required>
                    </div>

                    <div class="mb-3"><label class="form-label">Email</label>
                        <input type="email" name="email"
                            class="form-control" value="{{$user->email}}" required>
                    </div>

                    <div class="mb-3"><label class="form-label">Registration Number</label>
                        <input type="text" name="reg_no" class="form-control" value="{{$user->reg_no}}" required>
                            
                    </div>

                    <div class="mb-3"><label class="form-label">Password</label>
                        <input type="password" name="password"
                            class="form-control" required>
                    </div>

                    <div class="mb-3"><label class="form-label">Date of Birth</label>
                        <input type="date"
                            name="dob" class="form-control" value="{{$user->dob}}"required>
                    </div>

                    <div class="mb-3"><label class="form-label">Phone Number</label>
                        <input type="number"
                            name="phone_number" class="form-control" value="{{$user->phone_number}}"required>
                    </div>

                    <div class="mb-3"><label class="form-label">Whatsapp Number</label>
                        <input type="number"
                            name="whatsapp" class="form-control" value="{{$user->whatsapp}}"required>
                    </div>

                    <div class="mb-3"><label class="form-label">NIC</label>
                        <input type="text" name="nic"
                            class="form-control" value="{{$user->nic}}"required>
                    </div>

                    <div class="mb-3"><label class="form-label">Address Line 1</label>
                        <input type="text"
                            name="address_l1" class="form-control" value="{{$user->address_l1}}"required>
                    </div>

                    <div class="mb-3"><label class="form-label">Address Line 2</label>
                        <input type="text"
                            name="address_l2" class="form-control" value="{{$user->address_l2}}"required>
                    </div>

                    <div class="mb-3"><label class="form-label">City</label>
                        <input type="text" name="city"
                            class="form-control" value="{{$user->city}}"required>
                    </div>

                    <div class="mb-3"><label class="form-label">Province</label>
                        <input type="text" name="province"
                            class="form-control" value="{{$user->province}}"required>
                    </div>

                    <div class="mb-3"><label class="form-label">Postal Code</label>
                        <input type="text"
                            name="postal_code" class="form-control" value="{{$user->postal_code}}"required>
                    </div>

                    <div class="mb-3"><label class="form-label">Role</label>
                        <input type="text" name="role"
                            class="form-control" value="{{$user->role}}"required>
                    </div>

                    <div class="mb-3"><label class="form-label">Start Date</label>
                        <input type="date"
                            name="start_date" class="form-control" value="{{$user->start_date}}"required>
                    </div>

                    <div class="mb-3"><label class="form-label">Gender</label><select name="gender"
                            class="form-control" value="{{$user->gender}}">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select></div>
                    <div class="mb-3"><label class="form-label">Married</label><select name="married"
                            class="form-control" value="{{$user->married}}">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select></div>
                    <div class="mb-3"><label class="form-label">Experience</label>
                        <input type="text" name="experience" class="form-control" value="{{$user->experience}}">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Update User</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection