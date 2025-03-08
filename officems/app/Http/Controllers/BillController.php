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
use App\Models\PreviousBill;
use App\Mail\BillPaidNotification;

class BillController extends Controller
{
    public function index(Request $request)
    {
        $query = Bill::query();

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

        // if ($request->has('assign_quartaz') && $request->assign_quartaz != '') {
        //     $query->where('assign_quartaz', $request->assign_quartaz);
        // }

        $bills = $query->paginate(7);
        $qua = Quartaz::all(); // Fetch Quartaz data for filtering

        return view('bills.index', compact('bills', 'qua'));
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
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/bills'), $imageName);

            $imagePath = 'uploads/bills/' . $imageName;
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
                Mail::to($user->email)->send(new BillEmail($request, $imagePath));
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

        return response()->json($query->paginate(7));
    }


    public function getBillsById($id)
    {

        $bills = Bill::find($id);
        return view('bills.view', compact('bills'));
    }

    public function show($id)
    {
        $bill = Bill::with('user')->findOrFail($id);
        return view('view', compact('bill'));
    }

    public function previousBills()
    {
        $previousBills = PreviousBill::paginate(7);  // Paginate the previous bills
        return view('bills.previous', compact('previousBills'));
    }

    // public function complete(Request $request, $id)
    // {
    //     $bill = Bill::findOrFail($id);

    //     // Ensure only the assigned user can complete the bill
    //     if (Auth::user()->id !== $bill->assign_user) {
    //         return redirect()->back()->with('error', 'Unauthorized action.');
    //     }

    //     // Validate the uploaded file
    //     $request->validate([
    //         'payment_slip' => 'required|image|mimes:jpeg,png,jpg|max:2048'
    //     ]);

    //     // Store the payment slip
    //     $path = $request->file('payment_slip')->store('payment_slips', 'public');

    //     // Update the bill status
    //     $bill->update([
    //         'payment_slip' => $path,
    //         'is_paid' => true
    //     ]);

    //     // Send an email to the admin or assigned lecturer
    //     $admin = User::where('role', 'admin')->first();
    //     Mail::to($admin->email)->send(new BillPaidNotification($bill));

    //     return redirect()->back()->with('success', 'Bill payment completed successfully!');
    // }

    public function destroy($id)
    {
        // Find the bill to be deleted
        $bill = Bill::findOrFail($id);

        // Move the bill to the previous_bills table
        PreviousBill::create([
            'name' => $bill->name,
            'bill_id' => $bill->bill_id,
            'date' => $bill->date,
            'month' => $bill->month,
            'amount' => $bill->amount,
            'point' => $bill->point,
            'image' => $bill->image,
            'assign_user' => $bill->assign_user,
            'assign_quartaz' => $bill->assign_quartaz,
        ]);

        // Delete the bill from the bills table
        $bill->delete();

        // Redirect back with success message
        return redirect()->route('bills')->with('success', 'Bill deleted successfully!');
    }
}
