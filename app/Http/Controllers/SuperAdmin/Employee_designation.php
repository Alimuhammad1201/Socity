<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\sadmin\EmployeeDesignation;
use Illuminate\Http\Request;

class Employee_designation extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $designation = collect();
        if ($buildingAdmin) {
            $designation = EmployeeDesignation::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $designation = EmployeeDesignation::where('user_id', $userId)->get();
        }

//        $designation = EmployeeDesignation::where('user_id',auth()->id())->get();
        return view('superadmin.employee_designation.index', compact('designation'));
    }
    public function store(Request $request)
    {
       $validatedata = $request->validate([
            'designation' => 'required|string',
        ]);
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }
        EmployeeDesignation::create([
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),
            'designation' => $validatedata['designation'],
        ]);
        return redirect()->route('employee.designation')->with('success', 'Employee designation added successfully!');
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:employee_designation,id',
            'designation' => 'required|string|max:255',
        ]);
        $designation = EmployeeDesignation::findOrFail( $validatedData['id']);
        $designation->designation =  $validatedData['designation'];
        $designation->save();
        return redirect()->route('employee.designation')->with('success', 'Employee designation updated successfully!');
    }

    public function destroy($id)
    {
        $designation = EmployeeDesignation::where('user_id',auth()->id())->findOrFail($id);
        $designation->delete();
        return response()->json(['success' => true]);
    }
}
