<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\QuartazItem;

class QuartazItemController extends Controller
{
    public function create($id)
    {
        $items = Item::all();
        return view('quartaz.quartazitem', compact('items', 'id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required',
            'quartaz' => 'required',
        ]);

        QuartazItem::create($request->all());

        return back();


    }

    public function destroy($id)
    {
        // Find the user by ID
        $item = QuartazItem::findOrFail($id);

        // Delete the item
        $item->delete();

        // Redirect back with success message
        return back()->with('success', 'Item deleted successfully!');
    }
}
