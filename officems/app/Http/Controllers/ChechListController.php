<?php

namespace App\Http\Controllers;

use App\Models\Check_list;
use App\Models\ChecklistNote;
use App\Models\PreviousQuartaz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\QuartazUser;
use App\Models\ChecklistItem;

class ChechListController extends Controller
{
    public function index(Request $request)
    {
        $check = QuartazUser::join('users', 'quartaz_users.user_id', '=', 'users.id')
            ->join('quartaz', 'quartaz_users.quartaz_id', '=', 'quartaz.id')
            ->select('users.name', 'quartaz.num', 'users.id as user_id', 'quartaz.id as qua_id');

        $prevQ = PreviousQuartaz::join('users', 'previous_quartazs.user_id', '=', 'users.id')
            ->join('quartaz', 'previous_quartazs.quartaz_id', '=', 'quartaz.num')
            ->select('users.name', 'quartaz.num', 'users.id as user_id', 'quartaz.id as qua_id');

        // Correct request parameters
        if ($request->name) {
            $check->where('users.name', 'like', "%" . $request->name . "%");
        }

        if ($request->num) {
            $check->where('quartaz.num', $request->num);
        }

        if ($request->pname) {
            $prevQ->where('users.name', 'like', "%" . $request->pname . "%");
        }

        if ($request->pnum) {
            $prevQ->where('quartaz.num', $request->pnum);
        }

        // Fetch results only after all conditions are applied
        $check_list = $check->get();
        $prev = $prevQ->get();

        $check_list = $check->paginate(2);
        $prev = $prevQ->paginate(1);


        return view('checklist.index', compact('check_list', 'prev'));
    }

    public function create($user_id, $qua_id)
    {
        $check = Check_list::where('user_id', $user_id)->where('quartz_id', $qua_id)->get();
        return view('checklist.view', compact('check', 'user_id', 'qua_id'));
    }

    
    public function storeItems(Request $request)
    {
        info($request);
        $request->validate([
            'item_name' =>'required|string|max:255'
        ]);

        $item = new ChecklistItem();

        $item->item_name = $request->item_name;

        $item->save();

        return ChecklistItem::all();
    }

    public function getItems()
    {
        return ChecklistItem::all();
    }

    public function storeList(Request $request)
    {
        info($request);
        $request->validate([
            'user_id' => 'required',
            'quartz_id' => 'required',
            'item_id' => 'required',
            'qun' => 'required'
        ]);

        $list = new Check_list();

        $list->user_id = $request->user_id;
        $list->quartz_id = $request->quartz_id;
        $list->item = $request->item_id;
        $list->available_qty = $request->qun;

        $list->save();

        return response()->json(['message' => 'Success'], 200);
    }

    public function getList($user_id, $qua_id)
    {
        $list = Check_list::where('user_id', $user_id)
                ->where('quartz_id', $qua_id)
                ->join('checklist_items', 'check_lists.item', 'checklist_items.id')
                ->select('check_lists.*', 'checklist_items.item_name')
                ->get();

        $note = ChecklistNote::where('user_id', $user_id)
                             ->where('quartaz_id', $qua_id)
                             ->first();
        return response()->json(['list' => $list, 'note' => $note], 200);
    }

    public function addNote(Request $request)
    {
        $request->validate([
            'note' => 'required',
            'user_id' => 'required',
            'quartz_id' => 'required',
        ]);

        $note = ChecklistNote::where('user_id', $request->user_id)
                ->where('quartaz_id', $request->quartz_id)
                ->first();

        if(!$note){
            $note = new ChecklistNote();
        }
        

        $note->note = $request->note;
        $note->user_id = $request->user_id;
        $note->quartaz_id = $request->quartz_id;

        $note->save();

        return response()->json(['message' => 'success'], 201);

    }

    public function updateList(Request $request ,$id)
    {

        $list = Check_list::where('id', $id)->first();

        if (!$list) {
            return;
        }

        $list->available_qty = $request->available_qty;
        $list->working_qty = $request->working_qty;
        $list->damage_qty = $request->damage_qty;
        $list->remark = $request->remark;

        $list->save();

        return response()->json(['message' => 'success'], 200);
    }

    public function delete($id)
    {
        $item = Check_list::findOrFail($id);

        $item->delete();

        return response()->json(['message' => 'succes'], 200);
    }

}
