<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sadmin\Flatarea;
use App\Models\sadmin\Block;
class FlatAreaController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $flatAreas = collect();
        if ($buildingAdmin) {
            $flatAreas = FlatArea::where('building_admin_id', $buildingAdmin->id)->with('block')->get();
        } else {
            $flatAreas = FlatArea::where('user_id', $userId)->with('block')->get();
        }

//        $flatAreas = FlatArea::where('user_id',auth()->id())->with('block')->get();
        return view('superadmin.flatarea.index', compact('flatAreas'));
    }

    public function create()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $blocks = collect();
        if ($buildingAdmin) {
            $blocks = Block::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $blocks = Block::where('user_id', $userId)->get();
        }

//        $blocks = Block::where('user_id',auth()->id())->get();
        return view('superadmin.flatarea.create', compact('blocks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'flat_no' => 'required|string|max:255',
            'block' => 'required|string|max:255',
            'flat_type' => 'required|string|max:255',
            'flat_area' => 'required|string|max:255',
            'maintenance_rate' => 'required|numeric',
        ]);
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }

        $flatarea = new Flatarea();
        $flatarea->user_id = $userId;
        $flatarea->building_admin_id = auth()->guard('building_admin')->id();
        $flatarea->flat_no = $validated['flat_no'];
        $flatarea->block_id = $validated['block'];
//        $flatarea->block_id = $validated['block'];
        $flatarea->flat_type = $validated['flat_type'];
        $flatarea->flat_area = $validated['flat_area'];
        $flatarea->maintenance_rate = $validated['maintenance_rate'];

        $flatarea->save();
        return redirect()->back()->with('success', 'Flat Area registered successfully!');
     }

     public function edit($id)
     {
        $flat = Flatarea::find($id);
        $block = Block::where('user_id',auth()->id())->get();
        return view('superadmin.flatarea.edit', compact('flat', 'block'));
     }

    public function update(Request $request, $id)
    {

        $request->validate([
            'flat_no' => 'required|string|max:255',
            'block' => 'required|exists:block,id',
            'flat_type' => 'required|string',
            'flat_area' => 'required|numeric',
            'maintenance_rate' => 'required|numeric',
        ]);


        $flat = FlatArea::findOrFail($id);

        $flat->flat_no = $request->input('flat_no');
        $flat->block = $request->input('block');
        $flat->block_id = $request->input('block');
        $flat->flat_type = $request->input('flat_type');
        $flat->flat_area = $request->input('flat_area');
        $flat->maintenance_rate = $request->input('maintenance_rate');


        $flat->save();


        return redirect()->route('flatarea.index')->with('success', 'Flat area updated successfully!');
    }

    public function destroy($id)
    {
        $flat = Flatarea::where('user_id',auth()->id())->findOrFail($id);
        $flat->delete();
        return response()->json(['success' => true]);
    }


}
