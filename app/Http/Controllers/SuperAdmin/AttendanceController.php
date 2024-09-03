<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Attendance;
use App\Models\Sadmin\Employees;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('employee')->get();
        return view('superadmin.attendance.index',compact('attendances'));
    }

    public function create()
    {
        $employees = Employees::get();
        return view('superadmin.attendance.create',compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'employee_id' => 'required',
           'date' => 'required',
           'status' => 'required',
        ]);
        Attendance::create([
            'employee_id' => $request->employee_id,
            'date' => $request->date,
            'status' => $request->status,
        ]);
        return redirect()->route('attendance.index');
    }

    public function edit($id)
    {
        $attendances = Attendance::findOrFail($id);
        $employees = Employees::get();
        return view('superadmin.attendance.edit',compact('employees','attendances'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
           'employee_id' => 'required',
           'date' => 'required',
           'status' => 'required'
        ]);

        Attendance::findOrFail($id)->update([
           'employee_id' => $request->employee_id,
           'date' => $request->date,
           'status' => $request->status,
           'update_at' => Carbon::now(),
        ]);

        return redirect()->route('attendance.index');
    }

    public function destroy($id)
    {
        Attendance::findOrFail($id)->delete();
        return redirect()->back();
    }
}
