<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\AllotFlat;
use App\Models\Sadmin\Block;
use App\Models\Sadmin\FlatArea;
use App\Models\Sadmin\Allotment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AllotmentsController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $allot = collect();
        if ($buildingAdmin) {
            $allot = Allotment::where('building_admin_id', $buildingAdmin->id)->with(['block', 'flatArea'])->get();
        } else {
            $allot = Allotment::where('user_id', $userId)->with(['block', 'flatArea'])->get();
        }

//        $allot = Allotment::where('user_id',auth()->id())->with(['block', 'flatArea'])->get();
        return view('superadmin.allotments.index', compact('allot'));
    }

    public function create()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $block = collect();
        if ($buildingAdmin) {
            $block = Block::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $block = Block::where('user_id', $userId)->get();
        }

//        $block = Block::where('user_id',auth()->id())->get();
        return view('superadmin.allotments.create', compact('block'));
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'block' => 'required|integer',
            'flat_no' => 'required|array', // Validate as an array
            'flat_no.*' => 'integer', // Validate each flat number as an integer
            'owner_name' => 'required|string|max:255',
            'owner_contact' => 'required|digits_between:10,15',
            'alt_owner_contact' => 'nullable|digits_between:10,15',
            'owner_email' => 'required|email',
            'owner_nic' => 'required|string|max:255',
            'member_contact' => 'nullable|digits_between:10,15',
            'password' => 'required|string|min:8|confirmed',
//            'password_confirmation' => 'required|string|min:8|confirmed',
        ]);

        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }

        $allotment =  Allotment::create([
                'user_id' => $userId,
                'building_admin_id' => auth()->guard('building_admin')->id(),
                'block_id' => $request->block,
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

            foreach ($request->flat_no as $flat){
                AllotFlat::create([
                    'allotment_id' => $allotment->id,
                    'flat_id' => $flat,
                ]);
            }
        return redirect()->route('allotments.index')->with('success', 'Allotment added successfully');

    }
    public function getFlats($blockId)
    {
        $flats = FlatArea::where('block', $blockId)->get();
        return response()->json($flats);
    }
    public function edit($id)
    {
        $block = Block::where('user_id',auth()->id())->get();
        $flat = FlatArea::where('user_id',auth()->id())->get();
        $allot = Allotment::where('user_id',auth()->id())->findOrFail($id);
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
        if ($request->has('flat_no') && is_array($request->flat_no)) {
            foreach ($request->flat_no as $flat) {
                AllotFlat::findOrFail($id)->update([
                    'allotment_id' => $allot->id,
                    'flat_id' => $flat,
                ]);
            }
        } else {
            // Handle the case where `flat_no` is missing or not an array
            return back()->withErrors(['flat_no' => 'No flats were selected']);
        }
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


