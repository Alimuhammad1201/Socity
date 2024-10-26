<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\EmployeeDepart;
use Illuminate\Http\Request;

class employee_depart extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $depart = collect();
        if ($buildingAdmin) {
            $depart = EmployeeDepart::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $depart = EmployeeDepart::where('user_id', $userId)->get();
        }

//        $depart = EmployeeDepart::where('user_id',auth()->id())->get();
        return view('superadmin.employee_depart.index', compact('depart'));
    }
    public function store(Request $request)
    {
       $validatedata = $request->validate([
            'depart_name' => 'required|string',
        ]);
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }
        EmployeeDepart::create([
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),
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
        $depart = EmployeeDepart::where('user_id',auth()->id())->findOrFail($id);
        $depart->delete();
        return response()->json(['success' => true]);
    }
}
