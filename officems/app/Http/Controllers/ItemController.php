<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\PreviousItem;
use App\Models\QuartazItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query();

        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'staff') {
            $query->where('role', Auth::user()->role);
        }

        if ($request->has('item_id')) {
            $query->where('item_id', 'like', "%" . $request->item_id . "%");
        }

        if ($request->has('name')) {
            $query->where('name', 'like', "%" . $request->name . "%");
        }

        $items = $query->paginate(5);

        return view('items.index', compact('items'));
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

        return response()->json($query->paginate(7));
    }

    public function getItemsById($id)
    {

        $items = Item::find($id);
        $qua = QuartazItem::join('quartaz', 'quartaz_items.quartaz', 'quartaz.id')->where('quartaz_items.item_id', $id)->select('quartaz.num')->first();
        return view('items.view', compact('items', 'qua'));
    }

    public function edit($id)
    {
        $items = Item::findOrFail($id);
        return view('items.update', compact('items'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'item_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $items = Item::findOrFail($id);

        $items->update([
            'item_id' => $request->item_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('items')->with('success', 'Item updated successfully!');
    }


    public function show($id)
    {
        $item = Item::with('quarter')->findOrFail($id);
        return view('items.view', compact('item'));
    }

    public function previous()
    {
        $previous_items = PreviousItem::paginate(7);
        return view('items.previous', compact('previous_items'));
    }

    public function destroy($id)
    {
        // Find the user by ID
        $items = Item::findOrFail($id);
        $qitems = QuartazItem::join('quartaz', 'quartaz_items.quartaz', 'quartaz.id')->first();

        PreviousItem::create([
            'item_id' => $items->item_id,
            'name' => $items->name,
            'item_add_date' => $items->created_at,
            'description' => $items->description,
            'quartaz_num' => $qitems->num,
        ]);

        $items->delete();

        return redirect()->route('items')->with('success', 'Item deleted successfully!');
    }
}
