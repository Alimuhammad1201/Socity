<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Employees;
use App\Models\Sadmin\Leaves;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $leave = Leaves::with('employee')->get();
        return view('superadmin.leave.index', compact('leave'));
    }
    public function create()
    {
        $employees = Employees::get();
        return view('superadmin.leave.create',compact('employees'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'leave_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);
        Leaves::create([
           'employee_id' => $request->employee_id,
           'leave_type' => $request->leave_type,
           'start_date' => $request->start_date,
           'end_date' => $request->end_date,
           'status' => $request->status,
        ]);
        return redirect()->route('leave.index');
    }

    public function edit($id)
    {
        $leaves = Leaves::findOrFail($id);
        $employees = Employees::get();
        return view('superadmin.leave.edit',compact('employees','leaves'));
    }

    public function update(Request $request,$id)
    {
     $request->validate([
            'employee_id' => 'required',
            'leave_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);
        Leaves::findOrFail($id)->update([
           'employee_id' => $request->employee_id,
           'leave_type' => $request->leave_type,
           'start_date' => $request->start_date,
           'end_date' => $request->end_date,
           'status' => $request->status,
        ]);
        return redirect()->route('leave.index');
    }

    public function destroy($id)
    {
        Leaves::findOrFail($id)->delete();
        return redirect()->back();
    }
}
