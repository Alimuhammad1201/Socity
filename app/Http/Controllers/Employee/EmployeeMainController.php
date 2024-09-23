<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Sadmin\Employees;


class EmployeeMainController extends Controller
{
    public function employee_dashboard()
    {
        $employee = Auth::guard('employee_guard')->user();
        $employee_data = Employees::with(['depart', 'designation'])->Where('email', $employee->email)->first();
      

        return view('employee.dashboard', compact('employee', 'employee_data'));

    }
}
