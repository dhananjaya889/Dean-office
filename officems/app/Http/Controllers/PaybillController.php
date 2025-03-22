<?php

namespace App\Http\Controllers;

use App\Mail\BillPayid;
use App\Models\Paybill;
use App\Models\User;
use App\Models\Quartaz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaybillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Paybill::query();

        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'staff') {
            $query->where('assign_user', Auth::user()->id);
        }

        // Apply filters if provided
        if ($request->has('name') && $request->name != '') {
            $query->where('name', $request->name);
        }

        if ($request->has('bill_id') && $request->bill_id != '') {
            $query->where('bill_id', 'LIKE', '%' . $request->bill_id . '%');
        }

        $paybills = $query->paginate(6);
        $qua = Quartaz::all(); // Fetch Quartaz data for filtering

        return view('paybills.index', compact('paybills','qua'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', '!=', 'student')->get();
        $qua = Quartaz::all();
        return view('paybills.create', compact('users', 'qua'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'user_id' => 'required|string|max:255',
        'amount' => 'required|string',
        'bill_id' => 'required|string|max:255',
        'ref_id' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480',
        'bill_name' => 'required|string|max:255',
        ]);
       
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/paybills'), $imageName);

            $imagePath = 'uploads/paybills/' . $imageName;
        }

        Paybill::create([
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'bill_id' => $request->bill_id,
            'ref_id' => $request->ref_id,
            'image' => $imagePath,
            'bill_name' => $request->bill_name,
        ]);

        $data = [
            'user' => $request->user_id,
            'amount' => $request->amount,
            'bill_id' => $request->bill_id,
            'ref_id' => $request->ref_id,
            'bill_name' => $request->bill_name,
            'created_at' => $request->created_at,
        ];

        Mail::to(env('ADMIN_EMAIL'))->send(new BillPayid($data));

        return redirect()->route('paybills.index');
    }

    public function getPaybills(Request $request)
    {
        $query = Paybill::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('bill_id', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%");
        }

        return response()->json($query->paginate(7));
    }

    public function getPaybillsById($id)
    {

        $paybills = Paybill::find($id);
        return view('paybills.view', compact('paybills'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $paybills = Paybill::with('user')->findOrFail($id);
        return view('view', compact('paybills'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the user by ID
        $paybills = Paybill::findOrFail($id);

        // Delete the user
        $paybills->delete();

        // Redirect back with success message
        return redirect()->route('paybills.index')->with('success', 'Paybill deleted successfully!');
    }
}
