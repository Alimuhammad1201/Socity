<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\sadmin\EmployeeDesignation;
use Illuminate\Http\Request;

class Employee_designation extends Controller
{
    public function index()
    {
        $designation = EmployeeDesignation::get();
        return view('superadmin.employee_designation.index', compact('designation'));
    }
    public function store(Request $request)
    {
       $validatedata = $request->validate([
            'designation' => 'required|string',
        ]);
        EmployeeDesignation::create([
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
        $designation = EmployeeDesignation::findOrFail($id);
        $designation->delete();
        return response()->json(['success' => true]);
    }
}
