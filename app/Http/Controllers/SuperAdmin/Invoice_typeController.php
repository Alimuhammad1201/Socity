<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sadmin\Inv_type;

class Invoice_typeController extends Controller
{
    public function index()
    {
        $type = Inv_Type::get();
        return view ('superadmin.invoice_type.index', compact('type'));
    }

    public function store(Request $request)
    {
        // Validate the static and dynamic fields
        $validatedData = $request->validate([
            'inv_type' => 'required|string|max:255',
            'dynamic-fields.*' => 'nullable|string|max:255',
        ]);
    
    
        Inv_type::create([
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
    $type = Inv_Type::findOrFail($id);
    $type->delete();
    return response()->json(['success' => true]);
}
    
}
