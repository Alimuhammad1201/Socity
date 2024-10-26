<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Block;
use App\Models\Sadmin\Flat;
use App\Models\Sadmin\FlatArea;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $flats = collect();
        if ($buildingAdmin) {
            $flats = Flat::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $flats = Flat::where('user_id', $userId)->get();
        }

//        $flats = Flat::where('user_id',auth()->id())->with(['block', 'flatArea'])->get();
        return view('superadmin.Flat.index', compact('flats'));
    }

    public function create()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $block = collect();
        if ($buildingAdmin) {
            $block = Block::where('building_admin_id', $buildingAdmin->id)->get();
            $flat = FlatArea::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $block = Block::where('user_id', $userId)->get();
            $flat = FlatArea::where('user_id',$userId)->get();
        }

//        $flat = FlatArea::where('user_id',auth()->id())->get();
//        $block = Block::where('user_id',auth()->id())->get();
        return view('superadmin.Flat.create', compact('flat', 'block'));
    }

    public function store(Request $request)
    {
          $validated = $request->validate([
            'flat_no' => 'required|string|max:255',
            'block' => 'required|string|max:255',
            'floor' => 'required|string|max:255',
        ]);
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }

        $flat = new Flat();
        $flat->user_id = $userId;
        $flat->building_admin_id = auth()->guard('building_admin')->id();
        $flat->flat_id = $validated['flat_no'];
        $flat->block_id = $validated['block'];
        $flat->floor = $validated['floor'];
        $flat->created_at = Carbon::now();
        $flat->save();
        return redirect()->back()->with('success', 'Flat registered successfully!');

    }

    public function edit($id)
    {
        $flat = Flat::where('user_id', auth()->id())->where('id', $id)->firstOrFail();

        // Debug the $flat object to ensure it's being retrieved
        if (!$flat) {
            dd('Flat not found');
        }

        $block = Block::where('user_id', auth()->id())->get();

        // Debug the $block object to ensure blocks are retrieved
        if ($block->isEmpty()) {
            dd('No blocks found');
        }

        return view('superadmin.Flat.edit', compact('flat', 'block'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'flat_no' => 'required|string|max:255',
            'block' => 'required|exists:block,id',
            'floor' => 'required|numeric',
        ]);

        $flat = Flat::findOrFail($id);

        $flat->flat_no = $request->input('flat_no');
        $flat->block = $request->input('block');
        $flat->flat_id = $request->input('flat_no');
        $flat->block_id = $request->input('block');
        $flat->floor = $request->input('floor');

        $flat->save();
        return redirect()->route('flat.index')->with('success', 'Flat updated successfully!');
    }

    public function destroy($id)
    {
        $flat = Flat::where('user_id',auth()->id())->findOrFail($id);
        $flat->delete();
        return response()->json(['success' => true]);
    }

//    public function getFlats($blockId)
//    {
//        $flats = FlatArea::where('block', $blockId)->get();
//        return response()->json($flats);
//    }
}
