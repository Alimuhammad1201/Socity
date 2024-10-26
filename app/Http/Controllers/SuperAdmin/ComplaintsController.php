<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Complaints;
use App\Models\Sadmin\ComplaintType;
use Illuminate\Http\Request;
use App\Models\Sadmin\Block;
use App\Models\Sadmin\Allotment;
use App\Models\Sadmin\FlatArea;
use Illuminate\Support\Facades\DB;

class ComplaintsController extends Controller
{
    public function all_complaints()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $complaints = collect();
        if ($buildingAdmin) {
            $complaints = Complaints::where('building_admin_id', $buildingAdmin->id)->with(['block', 'flatArea', 'complaintType'])->get();
        } else {
            $complaints = Complaints::where('user_id', $userId)->with(['block', 'flatArea', 'complaintType'])->get();
        }
//        $complaints = Complaints::with(['block', 'flatArea', 'complaintType'])->get();
        return view('superadmin.complaints.index', ['complaints' => $complaints]);
    }



    public function unsolved()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $unsolved = collect();
        if ($buildingAdmin) {
            $unsolved = Complaints::where('building_admin_id', $buildingAdmin->id)->with(['block', 'flatArea', 'complaintType'])->where('status', 'Unresolved')->get();
        } else {
            $unsolved = Complaints::where('user_id', $userId)->with(['block', 'flatArea', 'complaintType'])->where('status', 'Unresolved')->get();
        }

//        $unsolved = Complaints::where('user_id',auth()->id())->with(['block', 'flatArea', 'complaintType'])->where('status', 'Unresolved')->get();
        return view ('superadmin.complaints.unsolved', compact('unsolved'));
    }

    public function inprogress()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $in_progress = collect();
        if ($buildingAdmin) {
            $in_progress = Complaints::where('building_admin_id', $buildingAdmin->id)->with(['block', 'flatArea', 'complaintType'])->where('status', 'In Progress')->get();
        } else {
            $in_progress = Complaints::where('user_id', $userId)->with(['block', 'flatArea', 'complaintType'])->where('status', 'In Progress')->get();
        }

//        $in_progress = Complaints::where('user_id',auth()->id())->with(['block', 'flatArea', 'complaintType'])->where('status', 'In Progress')->get();
        return view('superadmin.complaints.inprogress', compact('in_progress'));
    }
    public function resolved()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $resolved = collect();
        if ($buildingAdmin) {
            $resolved = Complaints::where('building_admin_id', $buildingAdmin->id)->with(['block', 'flatArea', 'complaintType'])->where('status', 'Resolved')->get();
        } else {
            $resolved = Complaints::where('user_id', $userId)->with(['block', 'flatArea', 'complaintType'])->where('status', 'Resolved')->get();
        }

//        $resolved = Complaints::with(['block', 'flatArea', 'complaintType'])->where('status', 'Resolved')->get();
        return view('superadmin.complaints.resolved' , compact('resolved'));
    }

    public function getOwner($flatId)
{
//    $allotment = Allotment::where('FlatNumber', $flatId)->first();
    $allotment = Allotment::where('flat_id', $flatId)->first();

    if ($allotment) {
        return response()->json(['ownerName' => $allotment->OwnerName, 'contact' => $allotment->OwnerContactNumber]);
    }

    return response()->json(['ownerName' => null, 'contact' => null]);
}

public function getFlats($blockId)
{
    $flats = FlatArea::where('block', $blockId)->get();
    return response()->json($flats);
}

public function update(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'id' => 'required|exists:complaints,id', // Make sure the ID exists
        'admin_remark' => 'required|string|max:255', // Removed extra space
        'status' => 'required|string|max:255',
        'after_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
    ]);

    // Find the complaint by the given ID
    $complaint = Complaints::findOrFail($validatedData['id']);

    $complaint->user_id = auth()->id();
    // Update the complaint fields with the new data
    $complaint->admin_remarks = $validatedData['admin_remark'];
    $complaint->status = $validatedData['status'];

    // Handle the image upload if there's a new image provided
    if ($request->hasFile('after_img')) {
        // Generate a unique file name for the image
        $imageName = time() . '.' . $request->after_img->extension();

        // Move the uploaded file to the desired directory
        $request->after_img->move(public_path('uploads/complaints'), $imageName);

        // Set the image name in the database
        $complaint->after_img = $imageName;
    }

    // Save the updated complaint data to the database
    $complaint->save();

    // Redirect back to the complaints index with a success message
    return redirect()->route('complaints.index')->with('success', 'Complaint updated successfully!');
}




}
