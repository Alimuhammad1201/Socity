<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Additional_Invoice_Detail;
use App\Models\Sadmin\Additional_Invoice_Master;
use App\Models\sadmin\Allotment;
use App\Models\Sadmin\Block;
use App\Models\Sadmin\FlatArea;
use App\Models\Sadmin\Inv_type;
use App\Models\Sadmin\InvDetail;
use App\Models\Sadmin\InvMaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $InvMaster = collect();
        if ($buildingAdmin) {
            $InvMaster = InvMaster::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $InvMaster = InvMaster::where('user_id', $userId)->get();
        }

//        $InvMaster = InvMaster::where('user_id',auth()->id())->get();
        return view('superadmin.invoice.index', compact('InvMaster'));
    }

    public function create()
    {
        $latestInvoice = DB::table('inv_master')->latest('id')->first();

        if ($latestInvoice) {
            // Extract the latest number
            $latestNumber = (int)substr($latestInvoice->Invoicenumber, 4);
            $nextNumber = $latestNumber + 1;
        } else {
            // Start from 1 if no invoices exist
            $nextNumber = 1;
        }
        // Generate the new invoice number
        $invoiceNumber = 'INV-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Store the invoice number in session
        session(['invoice_number' => $invoiceNumber]);

        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $inv_type = collect();
        if ($buildingAdmin) {
            $inv_type = Inv_type::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $inv_type = Inv_type::where('user_id', $userId)->get();
        }
//        $inv_type = Inv_type::where('user_id',auth()->id())->get();
        return view('superadmin.invoice.create', compact('inv_type'));
    }

    public function store(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'Invoicenumber' => 'required|string',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'Invoice_type.*' => 'required|integer',
            'amount.*' => 'required|numeric'
        ]);
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }
        // Insert invoice master record
        $invoiceMaster = InvMaster::create([
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),
            'Invoicenumber' => $request->Invoicenumber,
            'date' => $request->date,
            'description' => $request->description,
            'total' => $request->totalAmount,
            'after_due_date_amount' => $request->amount_after_due_date,
            'amount_after_due_total' => $request->subtotal,
        ]);

        // Insert invoice detail records
        foreach ($request->Invoice_type as $index => $type) {
            InvDetail::create([
                'user_id' => $userId,
                'building_admin_id' => auth()->guard('building_admin')->id(),
                'inv_master_id' => $invoiceMaster->id,
                'Invoice_type' => $type,
                'Invoice_type_id' => $type,
                'amount' => $request->amount[$index],
                'total' => $invoiceMaster->total,
            ]);
        }
        return redirect()->route('invoice.show', ['id' => $invoiceMaster->id])->with('success', 'Invoice created successfully!');
    }

    public function edit($id)
    {
        $inv_type = Inv_type::get();
        $invoice_edit = InvMaster::findOrFail($id);
        $invoice_detail = InvDetail::Where('inv_master_id', $id)->get();
        return view('superadmin.invoice.edit', compact('inv_type', 'invoice_edit', 'invoice_detail'));

    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'Invoicenumber' => 'required|string|max:255',
        //     'date' => 'required|date',
        //     'description' => 'nullable|string',
        //     'amount_after_due_date' => 'nullable|numeric',
        //     'totalAmount' => 'nullable|numeric',
        //     'subtotal' => 'nullable|numeric',
        //     'amount.*' => 'nullable|numeric',
        //     'Invoice_type.*' => 'nullable|exists:invoice_type,id',
        // ]);

        $invoice = InvMaster::findOrFail($id);
        $invoice->update([
            'Invoicenumber' => $request->Invoicenumber,
            'date' => $request->date,
            'description' => $request->description,
            'total' => $request->totalAmount,
            'after_due_date_amount' => $request->amount_after_due_date,
            'amount_after_due_total' => $request->subtotal,
        ]);
        $invoice->details()->delete(); // Delete existing details
        foreach ($request->Invoice_type as $key => $type) {
            if (!empty($type)) {
                $invoice->details()->create([
                    'Invoice_type_id' => $type,
                    'amount' => $request->amount[$key],
                ]);
            }
        }

        return redirect()->route('invoice.index')->with('success', 'Invoice updated successfully');


    }

    public function destroy($id)
    {
        $invoice = InvMaster::where('user_id',auth()->id())->findOrFail($id);
        $invoice->details()->delete();
        $invoice->delete();
        return redirect()->route('invoice.index')->with('success', 'Invoice deleted successfully');
    }

    public function showInvoice($invoiceId)
    {
        $invoice = DB::table('inv_master')->where('user_id',auth()->id())->where('id', $invoiceId)->first();
        $invoiceDetails = InvDetail::where('user_id',auth()->id())->with(['type']) ->where('inv_detail.inv_master_id', $invoiceId)->get();
        $totalAmount = $invoiceDetails->sum('amount');
        $chart = InvMaster::where('user_id',auth()->id())->get();
        return view('superadmin.invoice.invoice', [
            'invoice' => $invoice,
            'invoiceDetails' => $invoiceDetails,
            'totalAmount' => $totalAmount,
            'chart' => $chart
        ]);
    }

    public function AdditionalInvoice()
    {
        $latestadditionalinvoice = DB::table('additional_invoice_master')->where('user_id',auth()->id())->latest('id')->first();
        if ($latestadditionalinvoice) {
            $latestadditionalnyumber = (int)substr($latestadditionalinvoice->invoice_no, 4);
            $nextadditionalnyumber = $latestadditionalnyumber + 1;
        } else {
            $nextadditionalnyumber = 1;
        }
        $additionalinvoiceNumber = 'INV-' . str_pad($nextadditionalnyumber, 4, '0', STR_PAD_LEFT);
        session(['invoice_number' => $additionalinvoiceNumber]);

        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $block = collect();
        if ($buildingAdmin) {
            $block = Block::where('building_admin_id', $buildingAdmin->id)->get();
            $inv_type = Inv_type::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $block = Block::where('user_id', $userId)->get();
            $inv_type = Inv_type::where('user_id',$userId)->get();
        }

//        $block = Block::where('user_id',auth()->id())->get();
//        $inv_type = Inv_type::where('user_id',auth()->id())->get();
        return view('superadmin.invoice.additional_invoice', compact('block', 'inv_type'));
    }

    public function AdditionalStore(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'Invoicenumber' => 'required|string',
            'block' => 'required|string',
            'flat_no' => 'required|string',
            'name' => 'required|string',
            'contact' => 'required|string',
            'date' => 'required|string',
            'description' => 'nullable|string',
            'Invoice_type.*' => 'required|string',
            'amount.*' => 'required|numeric'
        ]);
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }
        // Insert invoice master record
        $additionalinvoiceMaster = Additional_Invoice_Master::create([
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),
            'invoice_no' => $request->Invoicenumber,
            'block_id' => $request->block,
            'flat_id' => $request->flat_no,
            'owner_name' => $request->name,
            'contact_no' => $request->contact,
            'due_date' => $request->date,
            'total' => $request->total,
            'description' => $request->description,
        ]);

        // Insert invoice detail records
        foreach ($request->Invoice_type as $index => $type) {
            Additional_Invoice_Detail::create([
                'user_id' => $userId,
                'building_admin_id' => auth()->guard('building_admin')->id(),
                'addi_invoice_master_id' => $additionalinvoiceMaster->id,
                'Invoice_type' => $type,
                'amount' => $request->amount[$index],
            ]);
        }

        // return redirect()->route('invoice.show', ['id' => $additionalinvoiceMaster->id])
        //                  ->with('success', 'Invoice created successfully!');
        return redirect()->route('additional_invoice.show', ['id' => $additionalinvoiceMaster->id])
            ->with('success', 'Invoice created successfully!');
    }

    public function getFlats($blockId)
    {
        $flats = FlatArea::where('block', $blockId)->get();
        return response()->json($flats);
    }

    public function AdditionalInvoiceshow($id)
    {
        // Retrieve the invoice master record
        $additionalinvoiceMaster = DB::table('additional_invoice_master')
            ->join('block', 'additional_invoice_master.block_id', '=', 'block.id')
            ->join('flat_area', 'additional_invoice_master.flat_id', '=', 'flat_area.id')
            ->select(
                'additional_invoice_master.id',
                'additional_invoice_master.invoice_no',
                'additional_invoice_master.owner_name',
                'additional_invoice_master.contact_no',
                'additional_invoice_master.due_date',
                'additional_invoice_master.description',
                'additional_invoice_master.total',
                'additional_invoice_master.created_at',
                'additional_invoice_master.updated_at',
                'block.Block_name',
                'flat_area.flat_no'
            )
            ->where('additional_invoice_master.id', $id)
            ->where('user_id',auth()->id())->first();

        // Convert due_date to Carbon instance if it's a string
        $additionalinvoiceMaster->due_date = Carbon::parse($additionalinvoiceMaster->due_date);

        // Retrieve the invoice detail records
        $additionalinvoiceDetails = $invoiceDetails = DB::table('additional_invoice_detail')
            ->join('invoice_type', 'additional_invoice_detail.Invoice_type', '=', 'invoice_type.id')
            ->where('addi_invoice_master_id', $id)
            ->select(
                'invoice_type.type_name',
                'additional_invoice_detail.id',
                'additional_invoice_detail.addi_invoice_master_id',
                'additional_invoice_detail.Invoice_type',
                'additional_invoice_detail.amount',
                'additional_invoice_detail.created_at',
                'additional_invoice_detail.updated_at'
            )
            ->where('user_id',auth()->id())->get();
        return view('superadmin.invoice.additional_invoice_show', compact('additionalinvoiceMaster', 'additionalinvoiceDetails'));
    }


    public function getOwner($flatId)
    {
        $allotment = Allotment::where('FlatNumber', $flatId)->first();

        if ($allotment) {
            return response()->json(['ownerName' => $allotment->OwnerName, 'contact' => $allotment->OwnerContactNumber]);
        }

        return response()->json(['ownerName' => null, 'contact' => null]);
    }


}
