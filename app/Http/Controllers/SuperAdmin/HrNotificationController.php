<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\HrNotification;
use Illuminate\Http\Request;

class HrNotificationController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $notification = collect();
        if ($buildingAdmin) {
            $notification = HrNotification::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $notification = HrNotification::where('user_id', $userId)->get();
        }

//        $notification = HrNotification::where('user_id',auth()->id())->get();
        return view('superadmin.hr_notification.index', compact('notification'));
    }

    public function create()
    {
        return view('superadmin.hr_notification.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'notification_type' => 'required',
            'message' => 'required',
            'date' => 'required',
            'status' => 'required',
        ]);


        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }

        HrNotification::create([
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),
            'notification_type' => $request->notification_type,
            'message' => $request->message,
            'date' => $request->date,
            'status' => $request->status,
        ]);
        return redirect()->route('hr_notification.index');

    }

    public function edit($id)
    {
        $notifications = HrNotification::where('user_id',auth()->id())->findOrFail($id);
        return view('superadmin.hr_notification.edit', compact('notifications'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'notification_type' => 'required',
            'message' => 'required',
            'date' => 'required',
            'status' => 'required',
        ]);
        HrNotification::findOrFail($id)->update([
            'notification_type' => $request->notification_type,
            'message' => $request->message,
            'date' => $request->date,
            'status' => $request->status,
        ]);
        return redirect()->route('hr_notification.index');
    }

    public function destroy($id)
    {
        HrNotification::where('user_id',auth()->id())->findOrFail($id)->delete();
        return redirect()->back();
    }

}
