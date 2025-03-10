<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;

use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\QuartazItem;

use App\Mail\MaintenanceMail;
use Illuminate\Support\Facades\Auth;
use Mail;

class MaintenanceController extends Controller
{
    public function index(Request $request)
    {
        

        $query = Maintenance::query();

        if (Auth::user()->role != 'admin' && Auth::user()->role != 'staff' && Auth::user()->role != 'maintenance') {
            
            $query->where('user_id', Auth::user()->reg_no);
        }

        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->item_id) {
            $query->where('item_id', $request->item_id);
        }
        if ($request->admin_approve) {
            $query->where('admin_approve', $request->admin_approve);
        }

        $maintens = $query->paginate(5);

        return view('maintenance.index', compact('maintens'));
    }

    public function create()
    {
        $itemsQ = QuartazItem::join('items', 'quartaz_items.item_id', '=', 'items.id');
       // dd($itemsQ->select('items.item_id', 'items.id', 'items.name')->get());
        if (Auth::user()->role != 'admin' && Auth::user()->role != 'staff') {
            $itemsQ->join('quartaz_users', 'quartaz_items.quartaz', '=', 'quartaz_users.quartaz_id')
                ->where('quartaz_users.user_id', Auth::user()->id);
        }

        $items = $itemsQ->select('items.item_id', 'items.id', 'items.name')->groupBy('items.item_id', 'items.id', 'items.name')->get();

        return view('maintenance.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'item_id' => 'nullable|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'admin_approve' => 'nullable|string',
            'mainten_status' => 'nullable|string',
            'maintenance_description' => 'nullable|string',
            'user_status' => 'required|string',
        ]);

        $imagePath = "";
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/maintenance'), $imageName);

            $imagePath = 'uploads/maintenance/' . $imageName;
        }

        $maintain = Maintenance::create(
            [
                'user_id' => $request->user_id,
                'item_id' => $request->item_id,
                'description' => $request->description,
                'image' => $imagePath,
                'admin_approve' => $request->admin_approve ?? 'open',
                'mainten_status' => $request->mainten_status ?? 'open',
                'maintenance_description' => $request->maintenance_description ?? '',
                'user_status' => $request->user_status,
            ]
        );

        $user = User::where('reg_no', $request->user_id)->first();
        $item = Item::find($request->item_id);
        $admin_aprove = $request->admin_approve ?? 'open';
        if ($admin_aprove == 'open') {
            $body = '<h4>New Maintenance</h4>
                    <br>
                    Hi, <br> There is a new maintenance Submited, check on your dashboard <br>
                        <br><b>From :</b> ' . $user->name . '
                        <br><b> Item : </b> ' . $item->name . '
                        <br><b>Description : </b>' . $request->description . '
                        <br>
                        <br>Best Regards,
                        <br>Faculty of Technology.';
            $data = [
                'title' => 'New Maintenance Submited',
                'body' => $body,
            ];

            Mail::to(env('ADMIN_MAINTENANCE_EMAIL'))->send(new MaintenanceMail($data));

        } elseif ($admin_aprove == 'tudo') {
            $body = '<h4>New Maintenance</h4>
                    <br>
                    Hi, <br> There is a new maintenance Submited, check on your dashboard <br>
                        <br><b>From :</b> ' . $user->name . '
                        <br><b> Item : </b> ' . $item->name . '
                        <br><b>Description : </b>' . $request->description . '
                        <br>
                        <br>Best Regards,
                        <br>Faculty of Technology.';
            $data = [
                'title' => 'New Maintenance Submited, check on your dashboard',
                'body' => $body,
            ];

            Mail::to(env('MAINTENANCE_EMAIL'))->send(new MaintenanceMail($data));
        }



        return redirect()->route('maintenance')->with('success', 'Inquery marked successful!');

    }

    public function edit(Maintenance $m)
    {
        $items = QuartazItem::join('items', 'quartaz_items.item_id', 'items.id')->select('items.item_id', 'items.id', 'items.name')->get();
        return view('maintenance.edit', compact('m', 'items'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|string',
            'item_id' => 'nullable|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'admin_approve' => 'nullable|string',
            'mainten_status' => 'nullable|string',
            'maintenance_description' => 'nullable|string',
            'user_status' => 'nullable|string',
        ]);

        $maintenance = Maintenance::findOrFail($id);

        if (!$maintenance) {
            return back()->with('error', 'This record can not be found');
        }

        $imagePath = $maintenance->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/maintenance'), $imageName);

            $imagePath = 'uploads/maintenance/' . $imageName;
        }

        $maintenance->user_id = $request->user_id;
        $maintenance->item_id = $request->item_id;
        $maintenance->description = $request->description;
        $maintenance->image = $imagePath;
        $maintenance->admin_approve = $request->admin_approve ?? 'open';
        $maintenance->mainten_status = $request->mainten_status ?? 'open';
        $maintenance->maintenance_description = $request->maintenance_description ?? '';
        $maintenance->user_status = $request->user_status ?? 'open';

        $maintenance->save();

        $user = User::where('reg_no', $request->user_id)->first();
        $item = Item::find($request->item_id);

        if ($request->admin_approve == 'tudo') {
            $body = '<h4>New Maintenance</h4>
                    <br>
                    Hi, <br> There is a new maintenance Submited, check on your dashboard
                        <br><b>From :</b> ' . $user->name . '
                        <br><b> Item : </b> ' . $item->name . '
                        <br><b>Description : </b>' . $request->description . '
                        <br>
                        <br>Best Regards,
                        <br>Faculty of Technology.';
            $data = [
                'title' => 'New Maintenance Submited, check on your dashboard',
                'body' => $body,
            ];
            info("call");
            Mail::to(env('MAINTENANCE_EMAIL'))->send(new MaintenanceMail($data));
        } elseif ($request->mainten_status == 'done') {
            $body = '<h4>Maintenance has been done</h4>
                    <br>
                    Hi, <br><br> The maintenance has been done by maintenance team <br>
                        <br><b>From :</b> ' . $user->name . '
                        <br><b> Item : </b> ' . $item->name . '
                        <br><b>Description : </b>' . $request->maintenance_description .'
                        <br>
                        <br>Best Regards,
                        <br>Faculty of Technology.';
            $data = [
                'title' => 'Complete Maintenance',
                'body' => $body,
            ];

            Mail::to(env('ADMIN_MAINTENANCE_EMAIL'))->send(new MaintenanceMail($data));

            Mail::to($user->email)->send(new MaintenanceMail($data));
        }

        return redirect()->route('maintenance')->with('success', 'Inquery updated successful!');
    }

    public function getMaintenance(Request $request)
    {
        $query = Maintenance::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('user_id', 'like', "%{$search}%")
                ->orWhere('item_id', 'like', "%{$search}%")
                ->orWhere('admin_approve', 'like', "%{$search}%");
        }

        return response()->json($query->paginate(7));
    }

    public function getMaintenanceById($id)
    {
        $maintenances = Maintenance::find($id);

        return view('maintenance.view', compact('maintenances'));
    }

    public function destroy($id)
    {
        $maintain = Maintenance::findOrFail($id);

        $maintain->delete();

        return redirect()->route('maintain')->with('success', 'Maintenance deleted successfully!');
    }

}
