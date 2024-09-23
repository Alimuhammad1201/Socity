<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\EmployeeDepart;
use Illuminate\Http\Request;

class employee_depart extends Controller
{
    public function index()
    {
        $depart = EmployeeDepart::get();
        return view('superadmin.employee_depart.index', compact('depart'));
    }
    public function store(Request $request)
    {
       $validatedata = $request->validate([
            'depart_name' => 'required|string',
        ]);
        EmployeeDepart::create([
            'depart_name' => $validatedata['depart_name'],
        ]);
        return redirect()->route('employee.depart')->with('success', 'Employee Depart added successfully!');
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:employee_depart,id',
            'depart_name' => 'required|string|max:255',
        ]);
        $depart = EmployeeDepart::findOrFail( $validatedData['id']);
        $depart->depart_name =  $validatedData['depart_name'];
        $depart->save();
        return redirect()->route('employee.depart')->with('success', 'Employee Depart updated successfully!');
    }

    public function destroy($id)
    {
        $depart = EmployeeDepart::findOrFail($id);
        $depart->delete();
        return response()->json(['success' => true]);
    }
}
