<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Employees;
use App\Models\Sadmin\Leaves;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeLeaveController extends Controller
{
    public function index()
    {
        $employee_action = Auth::guard('employee_guard')->user();
        $action_leave = Leaves::where('employee_email', $employee_action->email)->get();
        $count = 1;
        return view('employee.leave.index', compact('action_leave', 'count'));
    }
    public function create()
    {
        $employee = Auth::guard('employee_guard')->user();
        $employee_data = Employees::with(['depart', 'designation'])->where('email', $employee->email)->first();
        return view('employee.leave.create', compact('employee_data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'leave_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string|max:1000',
        ]);

        Leaves::create([
             'employee_id' => $request->employee,
             'employee_depart' => $request->depart,
             'employee_desi' => $request->designation,
             'employee_email' => $request->email,
             'description' => $request->description,
             'leave_type' => $request->leave_type,
             'start_date' => $request->start_date,
             'end_date' => $request->end_date,
        ]);

        // Data store karna


        // Success message ke saath redirect karna
        return redirect()->route('action.leave')->with('success', 'Leave has been added successfully.');
    }
}
