<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\ActivityLogs;
use App\Models\Sadmin\Employees;
use Illuminate\Http\Request;

class ActivityLogsController extends Controller
{
     public function index()
    {
        $activities = ActivityLogs::get();
        return view('superadmin.activity_logs.index',compact('activities'));
    }

    public function create()
    {
        $employees = Employees::get();
        return view('superadmin.activity_logs.create',compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'activity_type' => 'required',
            'employee_id' => 'required',
            'description' => 'required',
            'date' => 'required',
        ]);
        ActivityLogs::create([
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
        return view('superadmin.activity_logs.edit',compact('activities','employees'));
    }

    public function update(Request $request,$id)
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
