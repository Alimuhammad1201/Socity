<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Employees;
use App\Models\Sadmin\Payroll;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayrollController extends Controller
{

    public function index()
    {
        $payrolls = Payroll::with('employee')->get();
        return view('superadmin.payroll.index', compact('payrolls'));
    }

    public function create()
    {
        $employees = Employees::get();
        return view('superadmin.payroll.create',compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'employee_id' => 'required',
           'salary_amount' => 'required',
           'deducation'  => 'required',
           'net_salary' => 'required',
           'pay_date' => 'required|Date'
        ]);

        Payroll::create([
           'employee_id' => $request->employee_id,
           'salary_amount' => $request->salary_amount,
           'deducation' => $request->deducation,
           'net_salary' => $request->net_salary,
           'pay_date' => $request->pay_date,
           'created_at' => Carbon::now(),
        ]);

        return redirect()->route('payroll.index');
    }

    public function edit($id)
    {
        $payroll = Payroll::findOrFail($id);
        $employees = Employees::get();
        return view('superadmin.payroll.edit',compact('payroll','employees'));
    }

    public function update(Request $request ,$id)
    {
        $payroll_id = $request->id;

        $request->validate([
           'employee_id' => 'required',
           'salary_amount' => 'required',
           'deducation'  => 'required',
           'net_salary' => 'required',
           'pay_date' => 'required|Date'
        ]);

        Payroll::findOrFail($payroll_id)->update([
           'employee_id' => $request->employee_id,
           'salary_amount' => $request->salary_amount,
           'deducation' => $request->deducation,
           'net_salary' => $request->net_salary,
           'pay_date' => $request->pay_date,
            'update_at' => Carbon::now(),
        ]);

        return redirect()->route('payroll.index');
    }

    public function destroy($id)
    {
        Payroll::findOrFail($id)->delete();
        return redirect()->back();
    }
}
