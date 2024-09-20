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
        $tenants = TenancyAgreement::with('allotment')->get();
        return view('superadmin.tenancy_agreement.index', compact('tenants'));
    }

    public function create()
    {
        $allotments = Allotment::get();
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
        $document = $request->file('agreement_pdf')->store('tenancy_agreements');
        TenancyAgreement::create([
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
        $tenants = TenancyAgreement::findOrFail($id);
        $allotments = Allotment::get();
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
        TenancyAgreement::findOrFail($id)->delete();
        return redirect()->back();
    }
}
