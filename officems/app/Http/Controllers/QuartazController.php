<?php

namespace App\Http\Controllers;

use App\Models\Quartaz;
use App\Models\QuartazItem;
use App\Models\QuartazUser;
use Illuminate\Http\Request;

class QuartazController extends Controller
{
    public function index()
    {
        $quartaz = Quartaz::paginate(10);
        return view('quartaz.index', compact('quartaz'));
    }

    public function create()
    {
        return view('quartaz.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'num' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|max:255',
        ]);

        Quartaz::create([
            'num' => $request->num,
            'address' => $request->address,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('quartaz')->with('success', 'Quartz created successfully!');
    }

    public function getQuartaz(Request $request)
    {
        $query = Quartaz::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('num', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%");
        }

        return response()->json($query->paginate(7));
    }

    public function getQuartazById($id)
    {

        $quartaz = Quartaz::find($id);
        $items = QuartazItem::where('quartaz', $id)->join('items', 'quartaz_items.item_id', '=', 'items.id')->select('quartaz_items.*', 'items.name')->get();
        $user = QuartazUser::where('quartaz_id', $id)->join('users', 'quartaz_users.user_id', '=', 'users.id')->select('quartaz_users.*', 'users.name', 'users.email', 'users.phone_number')->first();

        return view('quartaz.view', compact('quartaz', 'items', 'user'));
    }

    public function getQuartazByUser($id)
    {
        $qu = QuartazUser::where('user_id', $id)->first();
        $qid = $qu->quartaz_id;
        $quartaz = Quartaz::find($qid);
        $items = QuartazItem::where('quartaz', $qid)->join('items', 'quartaz_items.item_id', '=', 'items.id')->select('quartaz_items.*', 'items.name')->get();
        $user = QuartazUser::where('quartaz_id', $qid)->join('users', 'quartaz_users.user_id', '=', 'users.id')->select('quartaz_users.*', 'users.name', 'users.email', 'users.phone_number')->first();

        return view('quartaz.view', compact('quartaz', 'items', 'user'));
    }

    public function edit($id)
    {
        $quartaz = Quartaz::findOrFail($id);
        return view('quartaz.update', compact('quartaz'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'num' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|max:255',
        ]);

        // Find the quartaz by ID
        $quartaz = Quartaz::findOrFail($id);

        // Update the quartaz record
        $quartaz->update([
            'num' => $request->num,
            'address' => $request->address,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        // Redirect back with a success message
        return redirect()->route('quartaz')->with('success', 'Quartaz updated successfully!');
    }



    public function destroy($id)
    {
        // Find the user by ID
        $quartaz = Quartaz::findOrFail($id);

        // Delete the user
        $quartaz->delete();

        // Redirect back with success message
        return redirect()->route('quartaz')->with('success', 'Quartz deleted successfully!');
    }
}

