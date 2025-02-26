<?php

namespace App\Http\Controllers;

use App\Models\Notices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use PHPUnit\Framework\Constraint\IsEmpty;
use PHPUnit\Framework\TestStatus\Notice;

class NoticeController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff') {
            $nortices = Notices::paginate(7);
        }else{
            $nortices = Notices::where('role', Auth::user()->role)->paginate(7);
        }
        
        return view('notices.index', compact('nortices'));
    }

    public function create()
    {
        return view('notices.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'create_date' => 'required|date',
            'title' => 'required|string|max:255',
            'role' =>  'required|string|max:255',
            'description' => 'required|string',
        ]);

        Notices::create([
            'create_date' => $request->create_date,
            'title' => $request->title,
            'role' => $request->role,
            'description' => $request->description,
        ]);

        return redirect()->route('notices')->with('success', 'Notice created successfully!');
    }

    public function getNotices(Request $request)
    {
        $query = Notices::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('create_date', 'like', "%{$search}%")
                ->orWhere('title', 'like', "%{$search}%");
        }

        return response()->json($query->paginate(7));
    }

    public function getNoticesById($id)
    {
        
        $notice = Notices::find($id);
        return view('notices.view', compact('notice'));
    }

    public function destroy($id)
    {
        // Find the user by ID
        $notice = Notices::findOrFail($id);

        // Delete the user
        $notice->delete();

        // Redirect back with success message
        return redirect()->route('notices')->with('success', 'Notice deleted successfully!');
    }
}
