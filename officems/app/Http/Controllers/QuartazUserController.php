<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\QuartazUser;

class QuartazUserController extends Controller
{
    public function create($id)
    {
        $user = User::where('role', 'lecture')->get();
        return view('quartaz.quartazuser', compact('user', 'id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'quartaz_id'=> 'required',
        ]);

        QuartazUser::create($request->all());

        return back();

    }

    public function destroy($id)
    {
        // Find the user by ID
        $user = QuartazUser::findOrFail($id);

        // Delete the user
        $user->delete();

        // Redirect back with success message
        return back()->with('success', 'Lecture deleted successfully!');
    }
}
