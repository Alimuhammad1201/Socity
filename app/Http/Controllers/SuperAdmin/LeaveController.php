<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Employees;
use App\Models\Sadmin\Leaves;
use Auth;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $leave = collect();
        if ($buildingAdmin) {
            $leave = Leaves::where('building_admin_id', $buildingAdmin->id)->with('employee')->get();
        } else {
            $leave = Leaves::where('user_id', $userId)->with('employee')->get();
        }

//        $leave = Leaves::where('user_id',auth()->id())->with('employee')->get();
        return view('superadmin.leave.index', compact('leave'));
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
//        $employees = Employees::where('user_id',auth()->id())->get();
        return view('superadmin.leave.create', compact('employees'));
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
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }

        Leaves::create([
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),
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
        $leaves = Leaves::where('user_id', auth()->id())->findOrFail($id);
        $employees = Employees::where('user_id', auth()->id())->get();
        return view('superadmin.leave.edit', compact('employees', 'leaves'));
    }

    public function update(Request $request, $id)
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
        return redirect()->route('leave.index')->with('success', 'Leave updated successfully.');
    }

    public function destroy($id)
    {
        Leaves::where('user_id', auth()->id())->findOrFail($id)->delete();
        return redirect()->back();
    }
}
