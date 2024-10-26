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
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $payrolls = collect();
        if ($buildingAdmin) {
            $payrolls = Payroll::where('building_admin_id', $buildingAdmin->id)->with(['employee'])->get();
        } else {
            $payrolls = Payroll::where('user_id', $userId)->with(['employee'])->get();
        }

//        $payrolls = Payroll::where('user_id',auth()->id())->with('employee')->get();
        return view('superadmin.payroll.index', compact('payrolls'));
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
        return view('superadmin.payroll.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'salary_amount' => 'required',
            'deducation' => 'required',
            'net_salary' => 'required',
            'pay_date' => 'required|Date'
        ]);
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }

        Payroll::create([
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),
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
        $payroll = Payroll::where('user_id', auth()->id())->findOrFail($id);
        $employees = Employees::get();
        return view('superadmin.payroll.edit', compact('payroll', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $payroll_id = $request->id;

        $request->validate([
            'employee_id' => 'required',
            'salary_amount' => 'required',
            'deducation' => 'required',
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
        Payroll::where('user_id', auth()->id())->findOrFail($id)->delete();
        return redirect()->back();
    }
}
