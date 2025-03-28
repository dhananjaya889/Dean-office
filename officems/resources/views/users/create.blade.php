@extends('layouts.admin')

@section('title', 'Adding a new staff member to the Faculty of Technology')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Create new staff member</div>
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
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text"name="first_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text"name="last_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email"class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Employee Number</label>
                            <input type="text"name="reg_no" class="form-control" placeholder="R00----" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password"class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date"name="dob" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="number"name="phone_number" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Whatsapp Number</label>
                            <input type="number"name="whatsapp" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIC</label>
                            <input type="text" name="nic"class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address Line 1</label>
                            <input type="text"name="address_l1" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address Line 2</label>
                            <input type="text"name="address_l2" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <input type="text" name="city"class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Province</label>
                            <input type="text" name="province"class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Postal Code</label>
                            <input type="text"name="postal_code" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            {{-- <input type="text" name="role" class="form-control" required> --}}
                            <select name="role" id="" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="staff">Staff</option>
                                <option value="lecturer">Lecturer</option>
                                <option value="temporary-lecturer">Temporary Lecturer</option>
                                <option value="temporary-demostrator">Temporary-Demostrator</option>
                                <option value="non-academic">Non-Acedamic</option>
                                <option value="maintenance">Maintenance</option>
                            </select>
                        </div>

                        <div class="mb-3"><label class="form-label">Start Date</label><input type="date"
                                name="start_date" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">Gender</label><select name="gender"
                                class="form-control">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select></div>
                        <div class="mb-3"><label class="form-label">Married</label><select name="married"
                                class="form-control">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="mb-3"><label class="form-label">Experience</label>
                            <textarea name="experience" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100" onclick="window.history.back();">Create Member</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
