<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Allotment;
use App\Models\Sadmin\Block;
use App\Models\Sadmin\Complaints;
use App\Models\Sadmin\ComplaintType;
use App\Models\Sadmin\Flat;
use App\Models\Sadmin\UserRent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRentController extends Controller
{
    public function index()
    {
        if (Auth::guard('flat_guard')->check()) {
            $user = Auth::guard('flat_guard')->user();
            $allot = Allotment::with(['block', 'flatArea'])->where('OwnerEmail', $user->OwnerEmail)->first();
            if ($allot) {
                $flat = $allot->flat_id;
                $block = $allot->block_id;
                $action = UserRent::where('flat_id', $flat)
                    ->where('block_id', $block)
                    ->get();
                return view('user.user_request.index', compact('action'));
            } else {

                return redirect()->back()->with('error', 'No allotment found for the logged-in user.');
            }
        }
        return redirect()->route('login')->with('error', 'Please login to view your invoices.');
    }

    public function create()
    {
        $block = Block::get();
        return view('user.user_request.create', compact('block'));
    }

    public function store(Request $request)
    {
        $nicFrontFileName = null;
        $nicBackFileName = null;

        if ($request->hasFile('nic_front')) {
            $file = $request->file('nic_front');
            $nicFrontFileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/user_rents/', $nicFrontFileName);
        }

        if ($request->hasFile('nic_back')) {
            $file = $request->file('nic_back');
            $nicBackFileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/user_rents/', $nicBackFileName);
        }
        UserRent::create([
            'user_id' => auth()->guard('admin')->id(),
            'block_id' => $request->input('block'),
            'flat_id' => $request->input('flat_no'),
            'request' => $request->input('request'),
            'owner_name' => $request->input('name'),
            'owner_contact' => $request->input('contact'),
            'renty_name' => $request->input('renty_name'),
            'renty_contact' => $request->input('renty_contact'),
            'nic_front' => $nicFrontFileName,
            'nic_back' => $nicBackFileName,
            'status' => 'pending',
        ]);
        return redirect()->route('rents.index');
    }

    public function edit($id)
    {
        $userrents = UserRent::with('allotment','block')->findOrFail($id);
        $block = Block::get();
        $flats = Flat::where('block_id', $userrents->block)->get();
        return view('superadmin.tenant.edit', compact('block','flats','userrents'));
    }

    public function update(Request $request, $id)
    {
        // Fetch the existing data for this record
        $existingData = UserRent::findOrFail($id);

// Initialize file names with existing values
        $nicFrontFileName = $existingData->nic_front;
        $nicBackFileName = $existingData->nic_back;

// Check if a new NIC Front image is uploaded
        if ($request->hasFile('nic_front')) {
            $file = $request->file('nic_front');
            $nicFrontFileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/user_rents/', $nicFrontFileName);
        }

// Check if a new NIC Back image is uploaded
        if ($request->hasFile('nic_back')) {
            $file = $request->file('nic_back');
            $nicBackFileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/user_rents/', $nicBackFileName);
        }

// Update the record
        $existingData->update([
            'block_id' => $request->input('block'),
            'flat_id' => $request->input('flat_no'),
            'request' => $request->input('request'),
            'admin_request' => $request->input('admin_request'),
            'owner_name' => $request->input('name'),
            'owner_contact' => $request->input('contact'),
            'renty_name' => $request->input('renty_name'),
            'renty_contact' => $request->input('renty_contact'),
            'nic_front' => $nicFrontFileName, // Update with the new or existing value
            'nic_back' => $nicBackFileName,   // Update with the new or existing value
            'status' => $request->input('status'),
        ]);


// Redirect to the index page
        return redirect()->route('superadminrents.index');
    }

    public function destroy()
    {

    }
    public function superadminindex()
    {
            $allot = Allotment::where('user_id',auth()->id())->with(['block', 'flatArea'])->first();
            if ($allot) {
                $flat = $allot->flat_id;
                $block = $allot->block_id;
                $action = UserRent::where('flat_id', $flat)
                    ->where('block_id', $block)
                    ->get();
                return view('superadmin.tenant.index', compact('action'));
            } else {

                return redirect()->back()->with('error', 'No allotment found for the logged-in user.');
            }

    }
}
