<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\sadmin\Allotment;
use App\Models\Sadmin\Booking;
use App\Models\Sadmin\CommunityHallBooking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $bookings = collect();
        if ($buildingAdmin) {
            $bookings = Booking::where('building_admin_id', $buildingAdmin->id)->with('communityHall','allotment')->get();
        } else {
            $bookings = Booking::where('user_id', $userId)->with('communityHall','allotment')->get();
        }
//        $bookings = Booking::where('user_id',auth()->id())->with('communityHall','allotment')->get();
        return view('superadmin.booking.index',compact('bookings'));
    }

    public function create()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $blocks = collect();

        if ($buildingAdmin) {
            $allotments = Allotment::where('building_admin_id', $buildingAdmin->id)->get();
            $communityHall = CommunityHallBooking::where('user_id', $userId)->get();

        } else {
            $allotments = Allotment::where('building_admin_id', $buildingAdmin->id)->get();
            $communityHall = CommunityHallBooking::where('user_id', $userId)->get();
        }

//        $allotments = Allotment::get();
//        $communityHall = CommunityHallBooking::get();
        return view('superadmin.booking.create', compact('allotments', 'communityHall'));
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'community_hall_id' => 'required|exists:community_hall_bookings,id',
            'allotment_id' => 'required|exists:allotments_a,id',
            'booking_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'amount' => 'required|numeric',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);
//        dd($request)->all();
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }
        // Create new booking entry
        Booking::create([
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),
            'community_hall_id' => $request->community_hall_id,
            'allotment_id' => $request->allotment_id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'amount' => $request->amount,
            'status' => $request->status,
        ]);

        // Redirect back with success message
        return redirect()->route('booking.index')->with('success', 'Booking created successfully.');
    }

    public function edit($id)
    {
        $communityHall = CommunityHallBooking::get();
        $allotments = Allotment::get();
        $bookings = Booking::findOrFail($id);
        return view('superadmin.booking.edit',compact('bookings','allotments','communityHall'));
    }
    public function update(Request $request,$id)
    {
         // Validate incoming request data
        $request->validate([
            'community_hall_id' => 'required|exists:community_hall_bookings,id',
            'allotment_id' => 'required|exists:allotments_a,id',
            'booking_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'amount' => 'required|numeric',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);
//        dd($request)->all();

        // Create new booking entry
        Booking::findOrFail($id)->update([
            'community_hall_id' => $request->community_hall_id,
            'allotment_id' => $request->allotment_id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'amount' => $request->amount,
            'status' => $request->status,
        ]);

        // Redirect back with success message
        return redirect()->route('booking.index')->with('success', 'Booking created successfully.');
    }
    public function destroy($id)
    {
        Booking::findOrFail($id)->delete();
        return redirect()->back();
    }
}
