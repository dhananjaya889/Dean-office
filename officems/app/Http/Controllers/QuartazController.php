<?php

namespace App\Http\Controllers;

use App\Models\Quartaz;
use App\Models\QuartazItem;
use App\Models\QuartazUser;
use Illuminate\Http\Request;
use App\Models\PreviousQuartaz;
use Illuminate\Support\Facades\Auth;

class QuartazController extends Controller
{
    public function index(Request $request)
    {
        
        $query = Quartaz::query();

        if (Auth::user()->role != 'admin' && Auth::user()->role != 'staff') {
            $query->where('role', Auth::user()->role);
        }
        
        if ($request->num) {
            
            $query->where('num',  $request->num );
        }

        if ($request->status) {
            
            $query->where('status', $request->status);
        }

        $quartaz = $query->paginate(6);
        $qua = Quartaz::all();

        return view('quartaz.index', compact('quartaz', 'qua'));
    }

    // public function index()
    // {
    //     $quartaz = Quartaz::paginate(10);
    //     return view('quartaz.index', compact('quartaz'));
    // }

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
            'type' => 'required|string|max:255',
            'ebill_no' => 'required|string|max:255',
            'wbill_no' => 'required|string|max:255',
            'rent' => 'required|string|max:255',
        ]);

        Quartaz::create([
            'num' => $request->num,
            'address' => $request->address,
            'description' => $request->description,
            'status' => $request->status,
            'type' => $request->type,
            'ebill_no' => $request->ebill_no,
            'wbill_no' => $request->wbill_no,
            'rent' => $request->rent,
        ]);

        return redirect()->route('quartaz')->with('success', 'Quarters created successfully!');
    }

    public function getQuartaz(Request $request)
    {
        $query = Quartaz::query();
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('num', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%");
        }

        return response()->json($query->paginate(6));
    }

    public function getQuartazById($id)
    {

        $quartaz = Quartaz::find($id);
        $items = QuartazItem::where('quartaz', $id)->join('items', 'quartaz_items.item_id', '=', 'items.id')->select('quartaz_items.*', 'items.name', 'items.item_id as item')->get();
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
            'type' => 'required|string|max:255',
            'ebill_no' => 'required|string|max:255',
            'wbill_no' => 'required|string|max:255',
            'rent' => 'required|string|max:255',
        ]);

        // Find the quartaz by ID
        $quartaz = Quartaz::findOrFail($id);

        // Update the quartaz record
        $quartaz->update([
            'num' => $request->num,
            'address' => $request->address,
            'description' => $request->description,
            'status' => $request->status,
            'type' => $request->type,
            'ebill_no' => $request->ebill_no,
            'wbill_no' => $request->wbill_no,
            'rent' => $request->rent,
        ]);

        // Redirect back with a success message
        return redirect()->route('quartaz')->with('success', 'Quarters updated successfully!');
    }

    public function previous()
    {
        $previous_quartaz = PreviousQuartaz::join('users', 'previous_quartazs.user_id', 'users.id') ->get(); 
       
        return view('quartaz.previous', compact('previous_quartaz'));
    }

    public function show($id)
    {
        $quartaz = Quartaz::findOrFail($id);
        $previous_quartaz = PreviousQuartaz::all();

        return view('quartaz.view', compact('quartaz', 'previous_quartaz'));
    }

    public function destroy($id)
    {
        $quartaz = Quartaz::findOrFail($id);
        $quser = QuartazUser::where('quartaz_id', $quartaz->id)->first();

        // Save details in previous_quartaz table before deletion
        PreviousQuartaz::create([
            'quartaz_id' => $quartaz->num,
            'user_id' => $quser ? $quser->user_id : null,
        ]);

        $quartaz->status = 'unselected';
        $quartaz->save();
        // Delete the quartaz record
        $quser->delete();

        return redirect()->route('quartaz')->with('success', 'Quarters moved to previous records successfully.');
    }
}

