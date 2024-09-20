<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\sadmin\Allotment;
use App\Models\Sadmin\PaymentStatus;
use Illuminate\Http\Request;

class PaymentStatusController extends Controller
{
    public function index()
    {
        $payments = PaymentStatus::with('allotment')->get();
        return view('superadmin.paymentstatus.index',compact('payments'));
    }
    public function create()
    {
        $allotments = Allotment::get();
        return view('superadmin.paymentstatus.create',compact('allotments'));
    }
    public function store(Request $request)
    {
        $request->validate([
           'allotment_id' => 'required',
           'payment_due' => 'required',
           'status' => 'required',
        ]);
        PaymentStatus::create([
           'allotment_id' => $request->allotment_id,
           'payment_due' => $request->payment_due,
           'status' => $request->status,
        ]);
        return redirect()->route('payment.index');
    }
    public function edit($id)
    {
        $payments = PaymentStatus::findOrFail($id);
        $allotments = Allotment::get();
        return view('superadmin.paymentstatus.edit',compact('payments','allotments'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'allotment_id' => 'required',
            'payment_due' => 'required',
            'status' => 'required',
        ]);

        PaymentStatus::findOrFail($id)->update([
           'allotment_id' => $request->allotment_id,
           'payment_due' => $request->payment_due,
           'status' => $request->status,
        ]);
        return redirect()->route('payment.index');
    }
    public function destroy($id)
    {
        PaymentStatus::findOrFail($id)->delete();
        return redirect()->back();
    }
}