<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\sadmin\Allotment;
use App\Models\Sadmin\CarSticker;
use Illuminate\Http\Request;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class CarStickerController extends Controller
{
    public function index()
    {
        $carstickers = CarSticker::with('allotment')->get();
        return view('superadmin.carsticker.index',compact('carstickers'));
    }
    public function create()
    {
        $allotments = Allotment::get();
        return view('superadmin.carsticker.create',compact('allotments'));
    }
    public function store(Request $request)
    {
        $request->validate([
           'allotment_id' => 'required',
           'car_number' => 'required',
           'sticker_id' => 'required',
           'issue_date' => 'required',
           'status' => 'required',
        ]);
        CarSticker::create([
           'allotment_id' => $request->allotment_id,
           'car_number' => $request->car_number,
           'sticker_id' => $request->sticker_id,
           'issue_date' => $request->issue_date,
           'expiry_date' => $request->expiry_date,
           'charges' => $request->charges,
           'status' => $request->status,
        ]);
        return redirect()->route('carsticker.index');
    }
    public function edit($id)
    {
        $carsticker = CarSticker::findOrFail($id);
        $allotments = Allotment::get();
        return view('superadmin.carsticker.edit',compact('carsticker','allotments'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'allotment_id' => 'required',
            'car_number' => 'required',
            'sticker_id' => 'required',
            'issue_date' => 'required',
            'status' => 'required',
        ]);
        CarSticker::findOrFail($id)->update([
            'allotment_id' => $request->allotment_id,
            'car_number' => $request->car_number,
            'sticker_id' => $request->sticker_id,
            'issue_date' => $request->issue_date,
            'expiry_date' => $request->expiry_date,
            'charges' => $request->charges,
            'status' => $request->status,
        ]);
        return redirect()->route('carsticker.index');
    }
    public function destroy($id)
    {
        CarSticker::findOrFail($id)->delete();
        return redirect()->back();
    }


    public function generatePdf($id)
    {
        // Get the car sticker data by ID
        $carSticker = CarSticker::find($id);

        if (!$carSticker) {
            return response()->json(['error' => 'Car sticker not found'], 404);
        }

        // Load the PDF view and pass the car sticker data
        $pdf = PDF::loadView('superadmin.pdf.car_sticker', ['carSticker' => $carSticker]);

        // Optional: Save PDF file if needed
        $pdfPath = 'pdfs/' . $carSticker->sticker_id . '.pdf';
        Storage::disk('public')->put($pdfPath, $pdf->output());

        // Download the generated PDF
        return $pdf->download('car_sticker_' . $carSticker->sticker_id . '.pdf');
    }
}
