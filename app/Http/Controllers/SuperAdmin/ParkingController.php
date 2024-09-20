<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\sadmin\Allotment;
use App\Models\Sadmin\Parking;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $parking = Parking::with('allotment')->get();
        return view('superadmin.parking.index',compact('parking'));
    }
    public function create()
    {
        $allotments = Allotment::get();
        return view('superadmin.parking.create',compact('allotments'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'allotment_id' => 'required',
           'parking_space_number' => 'required',
           'vehicle_number' => 'required',
           'parking_status' => 'required',
        ]);
        Parking::create([
           'allotment_id' => $request->allotment_id,
           'parking_space_number' => $request->parking_space_number,
           'vehicle_number' => $request->vehicle_number,
           'parking_status' => $request->parking_status,
        ]);
        return redirect()->route('parking.index');

    }
    public function edit($id)
    {
        $parking = Parking::findOrFail($id);
        $allotments = Allotment::get();
        return view('superadmin.parking.edit',compact('parking','allotments'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'allotment_id' => 'required',
            'parking_space_number' => 'required',
            'vehicle_number' => 'required',
            'parking_status' => 'required',
        ]);
        Parking::findOrFail($id)->update([
            'allotment_id' => $request->allotment_id,
            'parking_space_number' => $request->parking_space_number,
            'vehicle_number' => $request->vehicle_number,
            'parking_status' => $request->parking_status,
        ]);
        return redirect()->route('parking.index');
    }
    public function destroy($id)
    {
        Parking::findOrFail($id)->delete();
        return redirect()->back();
    }
}
