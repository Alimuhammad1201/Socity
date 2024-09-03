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
//        $allot = Allotment::get();
        $allot = Allotment::with(['block', 'flatArea'])
        ->select(
            'block.Block_name',
            'flat_area.flat_no',
            'allotments_a.id',
            'allotments_a.OwnerName',
            'allotments_a.OwnerEmail',
            'allotments_a.nic',
            'allotments_a.OwnerContactNumber',
            'allotments_a.OwnerAlternateContactNumber',
            'allotments_a.OwnerMemberCount',
            'allotments_a.status',
            'allotments_a.date',
            'allotments_a.created_at',
            'allotments_a.updated_at',
            'allotments_a.password'
        )
        ->join('block', 'allotments_a.BlockNumber', '=', 'block.id')
        ->join('flat_area', 'allotments_a.FlatNumber', '=', 'flat_area.id')
        ->get();
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
            'FlatNumber' => $request->flat_no,
            'BlockNumber' => $request->block,
            'OwnerName' => $request->owner_name,
            'OwnerEmail' => $request->owner_email,
            'nic' => $request->owner_nic,
            'OwnerContactNumber' => $request->owner_contact,
            'OwnerAlternateContactNumber' => $request->alt_owner_contact,
            'OwnerMemberCount' => $request->member_contact,
            'status' => '1', 
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
        $allot = Allotment::findOrFail($id);
        return view('superadmin.allotments.edit', compact('allot'));
    }

    public function destroy($id)
    {
        $allot = Allotment::findOrFail($id);
        $allot->delete();
        return response()->json(['success' => true]);
    }
    
}


