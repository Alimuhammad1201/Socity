<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function index()
    {
        $builderId = auth()->user()->id;
        $buildings = Building::with('user')->where('user_id', $builderId)->get();
        return view('admin.building.index', compact('buildings'));
    }

    public function create()
    {
        return view('admin.building.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'building_name' => 'required',
            'address' => 'required',
        ]);
        Building::create([
            'user_id' => auth()->user()->id,
            'building_name' => $request->building_name,
            'address' => $request->address,
        ]);
        return redirect(route('building.index'));
    }
    public function edit($id)
    {
        $building = Building::findOrFail($id);
        return view('admin.building.edit', compact('building'));
    }
    public function update(Request $request, $id)
    {
        request()->validate([
            'building_name' => 'required',
            'address' => 'required',
        ]);
        Building::findOrFail($id)->update([
            'building_name' => $request->building_name,
            'address' => $request->address,
        ]);
        return redirect(route('building.index'))->with('success','Building has been updated');
    }
    public function destroy($id)
    {
        Building::findOrFail($id)->delete();
        return redirect(route('building.index'))->with('success','Building has been deleted');
    }
}
