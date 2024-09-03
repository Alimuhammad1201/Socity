<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Additional_Invoice_Master;
use App\Models\sadmin\Allotment;
use App\Models\Sadmin\InvMaster;
use Illuminate\Support\Facades\Auth;
use user;

use Illuminate\Http\Request;

class UserInvoiceController extends Controller
{
    public function ViewInvoice()
    {
        $inv_data = InvMaster::get();
        return view('user.invoice.view', compact('inv_data'));
    }

    public function viewadditionalinvoice()
    {
        if (Auth::guard('flat_guard')->check()) {
            $user = Auth::guard('flat_guard')->user(); 
            $allot = Allotment::where('OwnerEmail', $user->OwnerEmail)->first();  
            if ($allot) {
                $flat = $allot->FlatNumber;
                $block = $allot->BlockNumber;
                $additional_invoice = Additional_Invoice_Master::where('flat_id', $flat)
                    ->where('block_id', $block)
                    ->get();     
                return view('user.invoice.additional_invoice', compact('additional_invoice'));
            } else {
          
                return redirect()->back()->with('error', 'No allotment found for the logged-in user.');
            }
        }
        return redirect()->route('login')->with('error', 'Please login to view your invoices.');
    }
}