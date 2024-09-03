<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\ComplaintType;
use Illuminate\Http\Request;

class ComplaintTypeController extends Controller
{
    public function index ()
    {
        $type = ComplaintType::get();
        return view ('superadmin.complaint_type.index', compact('type'));
    }
    public function store(Request $request)
    {
        // Validate the static and dynamic fields
        $validatedData = $request->validate([
            'add_type' => 'required|string', // Ensure that add_type is a string
        ]);


        ComplaintType::create([
            'complaint_type' => $validatedData['add_type'],
        ]);

        return redirect()->route('complaint.type')->with('success', 'Type added successfully!');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:complaint_type,id',
            'complaint_type' => 'required|string|max:255',
        ]);

        $type = ComplaintType::findOrFail($validatedData['id']);
        $type->complaint_type = $validatedData['complaint_type'];
        $type->save();

        return redirect()->route('complaint.type')->with('success', 'Type updated successfully!');
    }

    public function destroy($id)
{
    $type = ComplaintType::findOrFail($id);
    $type->delete();
    return response()->json(['success' => true]);
}

}
