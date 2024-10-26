<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\ActivityLogs;
use App\Models\Sadmin\Employees;
use Illuminate\Http\Request;

class ActivityLogsController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $activities = collect();
        if ($buildingAdmin) {
            $activities = ActivityLogs::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $activities = ActivityLogs::where('user_id', $userId)->get();
        }
//        $activities = ActivityLogs::where('user_id',auth()->id())->get();
        return view('superadmin.activity_logs.index', compact('activities'));
    }

    public function create()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $employees = collect();
        if ($buildingAdmin) {
            $employees = Employees::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $employees = Employees::where('user_id', $userId)->get();
        }
//        $employees = Employees::get();
        return view('superadmin.activity_logs.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'activity_type' => 'required',
            'employee_id' => 'required',
            'description' => 'required',
            'date' => 'required',
        ]);
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }
        ActivityLogs::create([
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),
            'activity_type' => $request->activity_type,
            'employee_id' => $request->employee_id,
            'description' => $request->description,
            'date' => $request->date,
        ]);
        return redirect()->route('activity_logs.index');

    }

    public function edit($id)
    {
        $activities = ActivityLogs::findOrFail($id);
        $employees = Employees::get();
        return view('superadmin.activity_logs.edit', compact('activities', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'activity_type' => 'required',
            'employee_id' => 'required',
            'description' => 'required',
            'date' => 'required',
        ]);
        ActivityLogs::findOrFail($id)->update([
            'activity_type' => $request->activity_type,
            'employee_id' => $request->employee_id,
            'description' => $request->description,
            'date' => $request->date,
        ]);
        return redirect()->route('activity_logs.index');
    }

    public function destroy($id)
    {
        ActivityLogs::findOrFail($id)->delete();
        return redirect()->back();
    }
}
