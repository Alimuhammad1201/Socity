<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Employees;
use App\Models\Sadmin\Flat;
use Carbon\Carbon;
use App\Models\Sadmin\EmployeeDepart;
use App\Models\sadmin\EmployeeDesignation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $employees = collect();
        if ($buildingAdmin) {
            $employees = Employees::where('building_admin_id', $buildingAdmin->id)->with(['depart', 'designation'])->get();
        } else {
            $employees = Employees::where('user_id', $userId)->with(['depart', 'designation'])->get();
        }

//        $employees = Employees::where('user_id',auth()->id())->with(['depart', 'designation'])->get();
        return view('superadmin.employees.index',compact('employees'));
    }
    public function create()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $block = collect();
        if ($buildingAdmin) {
            $designation = EmployeeDesignation::where('building_admin_id', $buildingAdmin->id)->get();
            $depart = EmployeeDepart::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $designation = EmployeeDesignation::where('user_id', $userId)->get();
            $depart = EmployeeDepart::where('user_id',$userId)->get();
        }

//        $designation = EmployeeDesignation::get();
//        $depart = EmployeeDepart::get();
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
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }

        Employees::insert([
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),
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
        $employees = Employees::where('user_id',auth()->id())->find($id);
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
        Employees::where('user_id',auth()->id())->findOrFail($id)->delete();
        return redirect()->back();
    }
}
