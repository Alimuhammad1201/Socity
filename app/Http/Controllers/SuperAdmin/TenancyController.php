<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\sadmin\Allotment;
use App\Models\Sadmin\TenancyAgreement;
use Illuminate\Http\Request;

class TenancyController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $tenants = collect();
        if ($buildingAdmin) {
            $tenants = TenancyAgreement::where('building_admin_id', $buildingAdmin->id)->with('allotment')->get();
        } else {
            $tenants = TenancyAgreement::where('user_id', $userId)->with('allotment')->get();
        }

//        $tenants = TenancyAgreement::where('user_id',auth()->id())->with('allotment')->get();
        return view('superadmin.tenancy_agreement.index', compact('tenants'));
    }

    public function create()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $allotments = collect();
        if ($buildingAdmin) {
            $allotments = Allotment::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $allotments = Allotment::where('user_id', $userId)->get();
        }

//        $allotments = Allotment::where('user_id',auth()->id())->get();
        return view('superadmin.tenancy_agreement.create', compact('allotments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'allotment_id' => 'required',
            'agreement_start' => 'required',
            'agreement_end' => 'required',
            'monthly_rent' => 'required',
            'payment_status' => 'required',
            'agreement_pdf' => 'required|mimes:pdf|max:2048',
        ]);
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }

        $document = $request->file('agreement_pdf')->store('tenancy_agreements');
        TenancyAgreement::create([
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),
            'allotment_id' => $request->allotment_id,
            'agreement_start' => $request->agreement_start,
            'agreement_end' => $request->agreement_end,
            'monthly_rent' => $request->monthly_rent,
            'payment_status' => $request->payment_status,
            'agreement_pdf' => $document,
        ]);
        return redirect()->route('tenancy.index');
    }

    public function edit($id)
    {
        $tenants = TenancyAgreement::where('user_id', auth()->id())->findOrFail($id);
        $allotments = Allotment::where('user_id', auth()->id())->get();
        return view('superadmin.tenancy_agreement.edit', compact('tenants', 'allotments'));
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request
        $request->validate([
            'allotment_id' => 'required',
            'agreement_start' => 'required|date',
            'agreement_end' => 'required|date',
            'monthly_rent' => 'required|numeric',
            'payment_status' => 'required|string',
            'agreement_pdf' => 'nullable|mimes:pdf|max:2048', // PDF file optional in update
        ]);

        // Find the TenancyAgreement record
        $tenancyAgreement = TenancyAgreement::findOrFail($id);

        // If a new document is uploaded, store it and update the record
        if ($request->hasFile('agreement_pdf')) {
            // Store the new document
            $document = $request->file('agreement_pdf')->store('tenancy_agreements');
        } else {
            // Use the old document path if no new file is uploaded
            $document = $tenancyAgreement->agreement_pdf;
        }

        // Update the record in the database
        $tenancyAgreement->update([
            'allotment_id' => $request->allotment_id,
            'agreement_start' => $request->agreement_start,
            'agreement_end' => $request->agreement_end,
            'monthly_rent' => $request->monthly_rent,
            'payment_status' => $request->payment_status,
            'agreement_pdf' => $document,
        ]);

        return redirect()->route('tenancy.index')->with('success', 'Tenancy Agreement updated successfully.');
    }

    public function destroy($id)
    {
        TenancyAgreement::where('user_id', auth()->id())->findOrFail($id)->delete();
        return redirect()->back();
    }
}
