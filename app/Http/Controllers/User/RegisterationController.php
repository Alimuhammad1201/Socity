<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\sadmin\Allotment;
use App\Models\Sadmin\FlatArea;
use App\Models\User\Registration;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterationController extends Controller
{
    public function register()
    {
        if (Auth::guard('flat_guard')->check()) {
            $user = Auth::guard('flat_guard')->user();
            $allotments = Allotment::with(['block', 'flatArea'])
            ->where('flat_id', $user->flat_id)
            ->first();
       
            return view('user.register.create', compact('user', 'allotments'));
        }else {
            return redirect('/login');
        }
    }

 public function store(Request $request)
 {
    $request->validate([
        'block' => 'required|string|max:255',
        'flat_no' => 'required|string|max:255',
        'owner_name' => 'required|string|max:255',
        'owner_contact_no' => 'required|string|max:255',
        'type' => 'required|string',
        'name' => 'required|string|max:255',
        'contact_no' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'nic_no' => 'required|string|max:255',
        'nic_front' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'nic_back' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',


    ]);
    $nic_front = null;
    if($request->hasFile('nic_front'))
    {
        $file = $request->file('nic_front');
        $nic_front = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
        $file->move(public_path('./uploads/registration/Nic'), $nic_front);
    }

    $nic_back = null;
    if($request->hasFile('nic_back'))
    {
        $file = $request->file('nic_back');
        $nic_back = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
        $file->move(public_path('./uploads/registration/Nic'), $nic_back);
    }

    $profile = null;
    if($request->hasFile('profile'))
    {
        $file = $request->file('profile');
        $profile = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
        $file->move(public_path('./uploads/registration/profile'), $profile);
    }


    $registration = new Registration ();
    $registration->block = $request->block;
    $registration->flat_no = $request->flat_no;
    $registration->owner_name = $request->owner_name;
    $registration->owner_contact_no = $request->owner_contact_no;
    $registration->type = $request->type;
    $registration->name = $request->name;
    $registration->contact_no = $request->contact_no;
    $registration->location = $request->location;
    $registration->nic_no = $request->nic_no;
    $registration->nic_front = $nic_front;
    $registration->nic_back = $nic_back;
    $registration->profile = $profile ;
    $registration->save();

    // Redirect with Success Message
    return redirect()->route('registration.card', ['id' => $registration->id])->with('success', 'Registration successful!');
 }

 public function showcard($id)
{
    $registration = Registration::findOrFail($id);
    return view('user.register.card', compact('registration'));
}
}
