<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\ComplaintType;
use Illuminate\Http\Request;

class ComplaintTypeController extends Controller
{
    public function index ()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $type = collect();
        if ($buildingAdmin) {
            $type = ComplaintType::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $type = ComplaintType::where('user_id', $userId)->get();
        }

//        $type = ComplaintType::where('user_id',auth()->id())->get();
        return view ('superadmin.complaint_type.index', compact('type'));
    }
    public function store(Request $request)
    {
        // Validate the static and dynamic fields
        $validatedData = $request->validate([
            'add_type' => 'required|string', // Ensure that add_type is a string
        ]);
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }

        ComplaintType::create([
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),
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
    $type = ComplaintType::where('user_id',auth()->id())->findOrFail($id);
    $type->delete();
    return response()->json(['success' => true]);
}

}
