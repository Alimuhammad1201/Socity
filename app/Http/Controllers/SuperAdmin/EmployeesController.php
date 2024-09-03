<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Employees;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employees::get();
        return view('superadmin.employees.index',compact('employees'));
    }
    public function create()
    {

        return view('superadmin.employees.create');
    }

    public function store(Request $request){
        $request->validate([
           'name' => 'required',
           'designation' => 'required',
           'hire_date' => 'required',
           'status' => 'required',
        ]);
        Employees::insert([
           'name' => $request->name,
           'designation' => $request->designation,
           'salary' => $request->salary,
           'hire_date' => $request->hire_date,
           'status' => $request->status,
           'created_at' => Carbon::now(),
        ]);
        return redirect()->route('employees.index');
    }

    public function edit($id)
    {
        $employees = Employees::find($id);
        return view('superadmin.employees.edit',compact('employees'));

    }

    public function update(Request $request)
    {
        $employee_id = $request->id;

        $request->validate([
           'name' => 'required',
           'designation' => 'required',
           'salary' => 'required',
           'hire_date' => 'required',
           'status' => 'required',
        ]);
        Employees::findOrFail($employee_id)->update([
           'name' => $request->name,
           'designation' => $request->designation,
           'salary' => $request->salary,
           'hire_date' => $request->hire_date,
           'status' => $request->status,
           'updated_at' => Carbon::now()
        ]);
        return redirect()->route('employees.index');
    }

    public function destroy(Request $request, $id)
    {
        Employees::findOrFail($id)->delete();
        return redirect()->back();
    }
}
