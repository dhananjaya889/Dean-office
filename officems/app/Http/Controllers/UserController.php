<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function getDashboard()
    {
        $user = Auth::user();
        info($user);
        return view('admin.index', compact('user'));
    }

    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'dob' => 'required|date',
            'phone_number' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'nic' => 'required|string|max:12',
            'address_l1' => 'required|string|max:255',
            'address_l2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'role' => 'required|string|max:50',
            'start_date' => 'required|date',
            'gender' => 'required|string|max:10',
            'married' => 'required|boolean',
            'experience' => 'nullable|string',
            'reg_no' => 'required|string|max:255',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dob' => $request->dob,
            'phone_number' => $request->phone_number,
            'whatsapp' => $request->whatsapp,
            'nic' => $request->nic,
            'address_l1' => $request->address_l1,
            'address_l2' => $request->address_l2,
            'city' => $request->city,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
            'role' => $request->role,
            'start_date' => $request->start_date,
            'gender' => $request->gender,
            'married' => $request->married,
            'experience' => $request->experience,
            'reg_no' => $request->reg_no,
        ]);

        return redirect()->route('users.create')->with('success', 'User created successfully!');
    }

    public function getUsers(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('email', 'like', "%{$search}%")
                ->orWhere('first_name', 'like', "%{$search}%")
                ->orWhere('province', 'like', "%{$search}%")
                ->orWhere('phone_number', 'like', "%{$search}%")
                ->orWhere('reg_no', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%");
        }

        return response()->json($query->paginate(7));
    }

    public function getUserById($id)
    {
        $user = User::find($id);
        return response()->json(['data' => $user]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.update', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'reg_no' => 'required|string|max:50',
            'password' => 'nullable|min:6',
            'dob' => 'required|date',
            'phone_number' => 'required|string|max:15',
            'whatsapp' => 'nullable|string|max:15',
            'nic' => 'required|string|max:12',
            'address_l1' => 'required|string|max:255',
            'address_l2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'role' => 'required|string|max:50',
            'start_date' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'married' => 'required|in:Yes,No',
            'experience' => 'nullable|string|max:255',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update user details
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->reg_no = $request->reg_no;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->dob = $request->dob;
        $user->phone_number = $request->phone_number;
        $user->whatsapp = $request->whatsapp;
        $user->nic = $request->nic;
        $user->address_l1 = $request->address_l1;
        $user->address_l2 = $request->address_l2;
        $user->city = $request->city;
        $user->province = $request->province;
        $user->postal_code = $request->postal_code;
        $user->role = $request->role;
        $user->start_date = $request->start_date;
        $user->gender = $request->gender;
        $user->married = $request->married;
        $user->experience = $request->experience;

        // Save updated user details
        $user->save();

        // Redirect back with success message
        return redirect()->route('users')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        // Redirect back with success message
        return redirect()->route('users')->with('success', 'User deleted successfully!');
    }

}
