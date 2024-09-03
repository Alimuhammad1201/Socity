<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\HrNotification;
use Illuminate\Http\Request;

class HrNotificationController extends Controller
{
    public function index()
    {
        $notification = HrNotification::get();
        return view('superadmin.hr_notification.index',compact('notification'));
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
        HrNotification::create([
           'notification_type' => $request->notification_type,
           'message' => $request->message,
           'date' => $request->date,
           'status' => $request->status,
        ]);
        return redirect()->route('hr_notification.index');

    }

    public function edit($id)
    {
        $notifications = HrNotification::findOrFail($id);
        return view('superadmin.hr_notification.edit',compact('notifications'));
    }

    public function update(Request $request,$id)
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
        HrNotification::findOrFail($id)->delete();
        return redirect()->back();
    }

}
