<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreviousBill;
use Barryvdh\DomPDF\Facade\Pdf;

class PreviousBillController extends Controller
{
    // Display all previous bills
    public function index()
    {
        // Fetch previous bills with related user and quartz data
        $previousBills = PreviousBill::with(['user', 'quartz'])->paginate(10);

        return view('bills.previous', compact('previousBills'));
    }

    // Show details of a specific previous bill
    public function show($id)
    {
        $bill = PreviousBill::with(['user', 'quartz'])->findOrFail($id);

        return view('bills.show', compact('bill'));
    }

    // Store a deleted bill in the previous_bills table
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bill_id' => 'required|string',
            'name' => 'required|string',
            'date' => 'required|date',
            'month' => 'required|string',
            'amount' => 'required|numeric',
            'point' => 'required|integer',
            'image' => 'nullable|string',
            'assign_user' => 'nullable|integer',
            'assign_quartaz' => 'nullable|integer',
        ]);

        PreviousBill::create($validated);

        return redirect()->route('previous.bills.index')->with('success', 'Bill stored successfully.');
    }

    // public function downloadPdf()
    // {
    //     $previousBills = PreviousBill::with(['user', 'quartz'])->get();

    //     $pdf = Pdf::loadView('bills.previous_pdf', compact('previousBills'));
    //     return $pdf->download('previous_bills.pdf');
    // }
}
