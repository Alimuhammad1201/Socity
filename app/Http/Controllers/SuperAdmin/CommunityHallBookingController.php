<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\CommunityHallBooking;
use Illuminate\Http\Request;

class CommunityHallBookingController extends Controller
{
    public function index()
    {
        $halls = CommunityHallBooking::get();
        return view('superadmin.community_hall.index',compact('halls'));
    }
    public function create()
    {
        return view('superadmin.community_hall.create');
    }
    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'rent' => 'required',
           'capacity' => 'required',
           'description' => 'required',
        ]);

        CommunityHallBooking::create([
           'hall_name' => $request->name,
           'rent' => $request->rent,
           'capecity' => $request->capacity,
           'description' => $request->description,
        ]);

        return redirect()->route('community_hall.index');
    }
    public function edit($id)
    {
        $halls = CommunityHallBooking::findOrFail($id);
        return view('superadmin.community_hall.edit',compact('halls'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
           'name' => 'required',
           'rent' => 'required',
           'capacity' => 'required',
           'description' => 'required',
        ]);

        CommunityHallBooking::findOrFail($id)->update([
           'hall_name' => $request->name,
           'rent' => $request->rent,
           'capecity' => $request->capacity,
           'description' => $request->description,
        ]);

        return redirect()->route('community_hall.index');
    }

    public function destroy($id)
    {
        CommunityHallBooking::findOrFail($id)->delete();
        return redirect()->back();
    }
}
