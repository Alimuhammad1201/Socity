<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\GuestTemporary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Shared\Validate;

class GuestTemporaryController extends Controller
{
    public function index()
    {
        $guest = GuestTemporary::get();
        return view('user.temporary_card_guest.mange', compact('guest'));
    }
    public function create()
    {

       
        $latestguest = DB::table('guest_temporary_detail')->latest('id')->first();
        if($latestguest) {
            // Extract the number part starting after 'CARD-'
            $newnumber = (int) substr($latestguest->card_no, 5); // Starting from the 5th character (after 'CARD-')
            $nextnumber = $newnumber + 1;
        } else {
            $nextnumber = 1;
        }
        
        // Generate new card number with the proper format
        $new_card_no = 'CARD-' . str_pad($nextnumber, 4, '0', STR_PAD_LEFT);
        
        // Save the new card number to session
        session(['card_no' => $new_card_no]);

        if (Auth::guard('flat_guard')->check()) {
            $user = Auth::guard('flat_guard')->user();
        }

       

        return view('user.temporary_card_guest.create', compact('user'));
    }

    public function store(Request $req)
    {

        $req->validate([
           'guest_name' => 'required|string',
           'check_in' => 'required',
        ]);    

       GuestTemporary::create([
           'card_no' => $req->card_no,
           'block_id' => $req->block_id,
           'flat_id' => $req->flat_id,
           'guest_name' => $req->guest_name,
           'contact_no' => $req->contact_no,
           'email' => $req->email,
           'check_in_time' => $req->check_in,
        ]);

        return redirect()->route('manage.card');

     
        
    }

    public function user_guest_edit($id)
    {
        if(Auth::guard('flat_guard')->check()){
            $user = Auth::guard('flat_guard')->user();
        }
        $guest = GuestTemporary::findOrFail($id);
        return view('user.temporary_card_guest.edit', compact('user', 'guest'));

    }

    public function update(Request $req, $id)
    {
        $guest = GuestTemporary::findOrFail($id);


        $req->validate([
            'guest_name' => 'required|string',
            'check_in' => 'required',
         ]);    
 
        $guest->update([
            'card_no' => $req->card_no,
            'block_id' => $req->block_id,
            'flat_id' => $req->flat_id,
            'guest_name' => $req->guest_name,
            'contact_no' => $req->contact_no,
            'email' => $req->email,
            'check_in_time' => $req->check_in,
         ]);
 
         return redirect()->route('manage.card');
 

    }

    public function admin_view()
    {
        $guest = GuestTemporary::get();
        return view('superadmin.guest_card.manage_guest', compact('guest'));
    }

    public function guest_checkout_admin(Request $req)
    {
        $validateData = $req->validate([
           'id' => 'required|exists:guest_temporary_detail,id',
           'check_out_time' => 'required',
        ]);
        $guest = GuestTemporary::findOrFail($validateData['id']);
        $guest->check_out_time = $validateData['check_out_time'];
        $guest->save();

        return redirect()->route('guest.view.admin')->with('success', 'guest updated successfully!');

    }
}
