<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Quartaz;
use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\SendBillEmail;
use Illuminate\Support\Facades\Mail;
use App\Mail\BillEmail;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff') {
            $bills = Bill::all();
        }else{
            $bills = Bill::where('assign_user', Auth::user()->id)->get();
        }

        return view('bills.index',compact('bills'));
    }

    public function create()
    {
        $users = User::where('role', '!=', 'student')->get();
        $qua = Quartaz::all();
        return view('bills.create', compact('users', 'qua'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bill_id' => 'required|string|max:255',
            'date' => 'required|string',
            'month' => 'required|string|max:255',
            'amount' => 'required|string',
            'point' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480',

        ]);

        // Handle file upload
        // dd($request);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/bills'), $imageName);

            $imagePath = 'uploads/bills/'.$imageName;
        }



        Bill::create([
            'name' => $request->name,
            'bill_id' => $request->bill_id,
            'date' => $request->date,
            'month' => $request->month,
            'amount' => $request->amount,
            'point' => $request->point,
            'image' => $imagePath,
            'assign_user' => $request->assign_user,
            'assign_quartaz' => $request->assign_quartaz,
        ]);

        // If assign_user exists, send an email with the bill details
        if ($request->assign_user) {
            $user = User::find($request->assign_user);

            if ($user && $user->email) {
                Mail::to($user->email)->send(new BillEmail($request,  $imagePath));
            }
        }

        return redirect()->route('bills')->with('success', 'Bill added successfully!');
    }

    public function getBills(Request $request)
    {
        $query = Bill::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('bill_id', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%");
        }

        return response()->json($query->paginate(10));
    }


    public function getBillsById($id)
    {

        $bills = Bill::find($id);
        return view('bills.view', compact('bills'));
    }

    public function destroy($id)
    {
        // Find the user by ID
        $bills = Bill::findOrFail($id);

        // Delete the user
        $bills->delete();

        // Redirect back with success message
        return redirect()->route('bills')->with('success', 'Bill deleted successfully!');
    }
}
