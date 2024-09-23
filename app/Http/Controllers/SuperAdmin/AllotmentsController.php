<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Block;
use App\Models\Sadmin\FlatArea;
use App\Models\Sadmin\Allotment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AllotmentsController extends Controller
{
    public function index()
    {
        $allot = Allotment::with(['block', 'flatArea'])->get();
        return view('superadmin.allotments.index', compact('allot'));
    }

    public function create()
    {
        $block = Block::get();
        return view('superadmin.allotments.create', compact('block'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'block' => 'required|integer',
            'flat_no' => 'required|integer',
            'owner_name' => 'required|string|max:255',
            'owner_contact' => 'required|digits_between:10,15',
            'alt_owner_contact' => 'nullable|digits_between:10,15',
            'owner_email' => 'required|email',
            'owner_nic' => 'required|string|max:255',
            'member_contact' => 'nullable|digits_between:10,15',
            'password' => 'required|string|min:8|confirmed',
//            'password_confirmation' => 'required|string|min:8|confirmed',
        ]);

        Allotment::create([
            'block_id' => $request->block,
            'flat_id' => $request->flat_no,
            'OwnerName' => $request->owner_name,
            'OwnerEmail' => $request->owner_email,
            'nic' => $request->owner_nic,
            'OwnerContactNumber' => $request->owner_contact,
            'OwnerAlternateContactNumber' => $request->alt_owner_contact,
            'OwnerMemberCount' => $request->member_contact,
            'status' => $request->status,
            'date' => now(),
            'password' => Hash::make($request->password),
            'confirm_password' => Hash::make($request->password_confirmation),
        ]);
        return redirect()->route('allotments.create')->with('success', 'Allotment added successfully');

    }
    public function getFlats($blockId)
    {
        $flats = FlatArea::where('block', $blockId)->get();
        return response()->json($flats);
    }
    public function edit($id)
    {
        $block = Block::get();
        $flat = FlatArea::get();
        $allot = Allotment::findOrFail($id);
        return view('superadmin.allotments.edit', compact('allot', 'block', 'flat'));
    }

    public function update(Request $request, $id)
    {
        $allot = Allotment::findOrFail($id);

        $allot->update([
            'block_id' => $request->block,
            'flat_id' => $request->flat,
            'OwnerName' => $request->owner_name,
            'OwnerEmail' => $request->owner_email,
            'nic' => $request->owner_nic,
            'OwnerContactNumber' => $request->owner_contact,
            'OwnerAlternateContactNumber' => $request->alt_owner_contact,
            'OwnerMemberCount' => $request->member_contact,
            'status' => $request->status,
            'date' => now(),

        ]);
        return redirect()->route('allotments.index');
    }

    public function destroy($id)
    {
        $allot = Allotment::findOrFail($id);
        $allot->delete();
        return response()->json(['success' => true]);
    }

//    public function getFlats($blockId)
//    {
//        $flats = FlatArea::where('block', $blockId)->get();
//        return response()->json($flats);
//    }
}


