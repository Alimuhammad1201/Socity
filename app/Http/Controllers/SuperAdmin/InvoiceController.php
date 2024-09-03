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
        $InvMaster = InvMaster::get();
        return view('superadmin.invoice.index', compact('InvMaster'));
    }

    public function create()
    {
        $latestInvoice = DB::table('inv_master')->latest('id')->first();
    
        if ($latestInvoice) {
            // Extract the latest number 
            $latestNumber = (int) substr($latestInvoice->Invoicenumber, 4); 
            $nextNumber = $latestNumber + 1;
        } else {
            // Start from 1 if no invoices exist
            $nextNumber = 1;
        }
        // Generate the new invoice number
        $invoiceNumber = 'INV-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    
        // Store the invoice number in session
        session(['invoice_number' => $invoiceNumber]);
    
        $inv_type = Inv_type::get();
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

        // Insert invoice master record
        $invoiceMaster = InvMaster::create([
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
                'inv_master_id' => $invoiceMaster->id,
                'Invoice_type' => $type,
                'amount' => $request->amount[$index],
                'total' => $invoiceMaster->total,
            ]);
        }

        return redirect()->route('invoice.show', ['id' => $invoiceMaster->id])
                         ->with('success', 'Invoice created successfully!');
    }

    public function showInvoice($invoiceId)
    {
        $invoice = DB::table('inv_master')->where('id', $invoiceId)->first();
        $invoiceDetails = DB::table('inv_detail')
        ->join('invoice_type', 'inv_detail.Invoice_type', '=', 'invoice_type.id')
        ->where('inv_detail.inv_master_id', $invoiceId)
        ->select(
            'invoice_type.type_name',
            'inv_detail.id',
            'inv_detail.inv_master_id',
            'inv_detail.Invoice_type',
            'inv_detail.amount',
            'inv_detail.created_at',
            'inv_detail.updated_at'
        )
        ->get();
        $totalAmount = $invoiceDetails->sum('amount');
        $chart = InvMaster::get();
        

        return view('superadmin.invoice.invoice', [
            'invoice' => $invoice,
            'invoiceDetails' => $invoiceDetails,
            'totalAmount' => $totalAmount,
            'chart' => $chart

        ]);
    }

    public function AdditionalInvoice()
    {
        $latestadditionalinvoice = DB::table('additional_invoice_master')->latest('id')->first();
        if ($latestadditionalinvoice) {
            $latestadditionalnyumber = (int) substr($latestadditionalinvoice->invoice_no, 4);
            $nextadditionalnyumber = $latestadditionalnyumber + 1;
        }
        else {
            $nextadditionalnyumber = 1;
        }
        $additionalinvoiceNumber = 'INV-' . str_pad($nextadditionalnyumber, 4, '0', STR_PAD_LEFT);
        session(['invoice_number' => $additionalinvoiceNumber]);

        
        $block = Block::get();
        $inv_type = Inv_type::get();
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

        // Insert invoice master record
        $additionalinvoiceMaster = Additional_Invoice_Master::create([
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
    ->first();

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
    ->get();
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
