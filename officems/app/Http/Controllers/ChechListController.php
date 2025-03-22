<?php

namespace App\Http\Controllers;

use App\Models\Check_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\QuartazUser;
use App\Models\ChecklistItem;

class ChechListController extends Controller
{
    public function index(Request $request)
    {
        //$check = Check_list::query();
        $check = QuartazUser::join('users', 'quartaz_users.user_id', 'users.id')
                    ->join('quartaz', 'quartaz_users.quartaz_id', 'quartaz.id')
                    ->select('users.name', 'quartaz.num', 'users.id as user_id', 'quartaz.id as qua_id')
                    ->get();
        // if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'staff') {
        //     $check->where('role', Auth::user()->role);
        // }

        if ($request->has('name')) {
            $check->where('name', 'like', "%" . $request->user_id . "%");
        }

        if ($request->has('num')) {
            $check->where('num', 'like', "%" . $request->quartaz_id . "%");
        }

        $check_list = $check;

        return view('checklist.index', compact('check_list'));
    }

    public function create($user_id, $qua_id)
    {
        $check = Check_list::where('user_id', $user_id)->where('quartz_id', $qua_id)->get();
        return view('checklist.view', compact('check'));
    }

    
    public function storeItems(Request $request)
    {
        $request->validate([
            'item_name' =>'required|string|max:255'
        ]);

        $item = new ChecklistItem();

        $item->item_name = $request->item_name;

        $item->save();

        return ChecklistItem::all();
    }
}
