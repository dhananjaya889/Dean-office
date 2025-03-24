<?php

namespace App\Http\Controllers;

use App\Models\Quartaz;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\QuartazUser;
use App\Mail\QuartazUserAddedMail;
use Illuminate\Support\Facades\Mail;

class QuartazUserController extends Controller
{
    public function create($id)
    {
       
        $quids = QuartazUser::pluck('user_id')->toArray();

       
        $user = User::whereIn('role', ['staff','lecturer','', 'temporary-lecturer','temporary-demostrator','non-academic','maintenance'])
                    ->whereNotIn('id', $quids)
                    ->get();

        return view('quartaz.quartazuser', compact('user', 'id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'quartaz_id'=> 'required',
        ]);

        QuartazUser::create($request->all());

        $user = User::find($request->user_id);
        $qua = Quartaz::find($request->quartaz_id);

        if ($user) {
            Mail::to($user->email)->send(new QuartazUserAddedMail($qua, $user));
        }

        return redirect()->route('quartaz.show', ['id' => $request->quartaz_id]);

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
