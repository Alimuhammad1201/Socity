<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\CommunityHallBooking;
use Illuminate\Http\Request;

class CommunityHallBookingController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $halls = collect();
        if ($buildingAdmin) {
            $halls = CommunityHallBooking::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $halls = CommunityHallBooking::where('user_id', $userId)->get();
        }

//        $halls = CommunityHallBooking::where('user_id', auth()->id())->get();
        return view('superadmin.community_hall.index', compact('halls'));
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
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }

        CommunityHallBooking::create([
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),
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
        return view('superadmin.community_hall.edit', compact('halls'));
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
