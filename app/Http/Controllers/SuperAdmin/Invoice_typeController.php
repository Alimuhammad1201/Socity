<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sadmin\Inv_type;

class Invoice_typeController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $type = collect();
        if ($buildingAdmin) {
            $type = Inv_Type::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $type = Inv_Type::where('user_id', $userId)->get();
        }

//        $type = Inv_Type::where('user_id',auth()->id())->get();
        return view ('superadmin.invoice_type.index', compact('type'));
    }

    public function store(Request $request)
    {
        // Validate the static and dynamic fields
        $validatedData = $request->validate([
            'inv_type' => 'required|string|max:255',
            'dynamic-fields.*' => 'nullable|string|max:255',
        ]);
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }

        Inv_type::create([
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),
            'type_name' => $validatedData['inv_type'],
        ]);

        return redirect()->route('invoice.type')->with('success', 'Type added successfully!');
    }

    public function update(Request $request)
{
    $validatedData = $request->validate([
        'id' => 'required|exists:invoice_type,id',
        'type_name' => 'required|string|max:255',
    ]);

    $type = Inv_Type::findOrFail($validatedData['id']);
    $type->type_name = $validatedData['type_name'];
    $type->save();

    return redirect()->route('invoice.type')->with('success', 'Type updated successfully!');
}

public function destroy($id)
{
    $type = Inv_Type::where('user_id',auth()->id())->findOrFail($id);
    $type->delete();
    return response()->json(['success' => true]);
}

}
