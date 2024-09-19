<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\EmployeeDepart;
use App\Models\sadmin\EmployeeDesignation;
use App\Models\Sadmin\Employees;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employees::with(['depart', 'designation'])->get();
        return view('superadmin.employees.index',compact('employees'));
    }
    public function create()
    {
        $designation = EmployeeDesignation::get();
        $depart = EmployeeDepart::get();
        return view('superadmin.employees.create', compact('designation', 'depart'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'depart' => 'required',
            'hire_date' => 'required',
            'status' => 'required',
            'st_time' => 'required',
            'en_time' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:8|confirmed',

        ]);
    
        Employees::insert([
            'name' => $request->name,
            'designation_id' => $request->designation,
            'depart_id' => $request->depart,
            'salary' => $request->salary,
            'hire_date' => $request->hire_date,
            'status' => $request->status,
            'start_time' => $request->st_time,
            'end_time' => $request->en_time,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);
    
        return redirect()->route('employees.index')->with('success', 'Employee added successfully');
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
