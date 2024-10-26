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
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $parking = collect();
        if ($buildingAdmin) {
            $parking = Parking::where('building_admin_id', $buildingAdmin->id)->with(['allotment'])->get();
        } else {
            $parking = Parking::where('user_id', $userId)->with(['allotment'])->get();
        }

//        $parking = Parking::where('user_id',auth()->id())->with('allotment')->get();
        return view('superadmin.parking.index',compact('parking'));
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
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }

        Parking::create([
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),
           'allotment_id' => $request->allotment_id,
           'parking_space_number' => $request->parking_space_number,
           'vehicle_number' => $request->vehicle_number,
           'parking_status' => $request->parking_status,
        ]);
        return redirect()->route('parking.index');

    }
    public function edit($id)
    {
        $parking = Parking::where('user_id',auth()->id())->findOrFail($id);
        $allotments = Allotment::where('user_id',auth()->id())->get();
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
        Parking::where('user_id',auth()->id())->findOrFail($id)->delete();
        return redirect()->back();
    }
}
