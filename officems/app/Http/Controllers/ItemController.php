<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index',compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Item::create([
            'item_id' => $request->item_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('items')->with('success', 'Item created successfully!');
    }

    public function getItems(Request $request)
    {
        $query = Item::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('item_id', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%");
        }

        return response()->json($query->paginate(10));
    }

    public function getItemsById($id)
    {
        
        $items = Item::find($id);
        return view('items.view', compact('items'));
    }

    public function destroy($id)
    {
        // Find the user by ID
        $items = Item::findOrFail($id);

        // Delete the user
        $items->delete();

        // Redirect back with success message
        return redirect()->route('items')->with('success', 'Item deleted successfully!');
    }
}
