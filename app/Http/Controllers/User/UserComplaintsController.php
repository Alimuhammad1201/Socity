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
        $fileName = null;
        if($request->hasFile('before_img'))
        {
            $file = $request->file('before_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/complaints/', $fileName);
        }
        Complaints::create([
            'block_id' => $request->block,
            'flat_id' => $request->flat_no,
            'complaint_type_id' => $request->complaint_type,
            'description' => $request->description,
            'owner_name' => $request->name,
            'owner_contact' => $request->contact,
            'before_img' => $fileName,
            'status' => 'Unresolved',
            'after_img' => 'No image found'
        ]);

        
        return redirect()->back();
        

    }

    public function getOwner($flatId)
    {
        $allotment = Allotment::where('flat_id', $flatId)->first();
    
        if ($allotment) {
            return response()->json(['ownerName' => $allotment->OwnerName, 'contact' => $allotment->OwnerContactNumber]);
        }
    
        return response()->json(['ownerName' => null, 'contact' => null]);
    }

    public function complain_action()
    {
        if (Auth::guard('flat_guard')->check()) {
            $user = Auth::guard('flat_guard')->user(); 
            $allot = Allotment::with(['block', 'flatArea'])->where('OwnerEmail', $user->OwnerEmail)->first();  
            if ($allot) {
                $flat = $allot->flat_id;
                $block = $allot->block_id;
                $action = Complaints::where('flat_id', $flat)
                    ->where('block_id', $block)
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
