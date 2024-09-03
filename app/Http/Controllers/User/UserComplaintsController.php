<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sadmin\Complaints;
use App\Models\Sadmin\Block;
use App\Models\Sadmin\ComplaintType;
use App\Models\Sadmin\Allotment;
use App\Models\Sadmin\FlatArea;
use Illuminate\Support\Facades\Auth;


class UserComplaintsController extends Controller
{
    public function create()
    {
        $block = Block::get();
        $type = ComplaintType::get();
        return view ('superadmin.complaints.create', compact('block','type'));
    }
    public function store(Request $request)
    {
        Complaints::create([
            'block' => $request->block,
            'flat_no' => $request->flat_no,
            'complaint_type' => $request->complaint_type,
            'description' => $request->description,
            'owner_name' => $request->name,
            'owner_contact' => $request->contact,
            'status' => 'Unresolved',
        ]);
        return redirect()->back();
        

    }

    public function getOwner($flatId)
    {
        $allotment = Allotment::where('FlatNumber', $flatId)->first();
    
        if ($allotment) {
            return response()->json(['ownerName' => $allotment->OwnerName, 'contact' => $allotment->OwnerContactNumber]);
        }
    
        return response()->json(['ownerName' => null, 'contact' => null]);
    }

    public function complain_action()
    {
        if (Auth::guard('flat_guard')->check()) {
            $user = Auth::guard('flat_guard')->user(); 
            $allot = Allotment::where('OwnerEmail', $user->OwnerEmail)->first();  
            if ($allot) {
                $flat = $allot->FlatNumber;
                $block = $allot->BlockNumber;
                $action = Complaints::where('flat_no', $flat)
                    ->where('block', $block)
                    ->get();     
                return view('user.complaints.action_complaints', compact('action'));
            } else {
          
                return redirect()->back()->with('error', 'No allotment found for the logged-in user.');
            }
        }
        return redirect()->route('login')->with('error', 'Please login to view your invoices.');
    }
    
    public function getFlats($blockId)
    {
        $flats = FlatArea::where('block', $blockId)->get();
        return response()->json($flats);
    }
}
