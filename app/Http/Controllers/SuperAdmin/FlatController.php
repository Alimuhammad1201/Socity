<?php

namespace App\Http\Controllers\superadmin;

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
        $flat = Flat::get();
        return view('superadmin.Flat.index', compact('flat'));
        $flats = Flat::with(['block', 'flatArea'])
        ->select('flats.id', 'flats.floor', 'flats.block', 'flats.created_at', 'flats.updated_at', 'flat_area.flat_no', 'block.Block_name')
        ->join('block', 'flats.block', '=', 'block.id')
        ->join('flat_area', 'flats.flat_no', '=', 'flat_area.id')
        ->get();
        return view('superadmin.Flat.index', compact('flats'));
    }

    public function create()
    {
        $flat = FlatArea::get();
        $block = Block::get();
        return view('superadmin.Flat.create', compact('flat', 'block'));
    }

    public function store(Request $request)
    {
          $validated = $request->validate([
            'flat_no' => 'required|string|max:255',
            'block' => 'required|string|max:255',
            'floor' => 'required|string|max:255',    
        ]);
        $flat = new Flat();
        $flat->flat_no = $validated['flat_no'];
        $flat->block = $validated['block'];
        $flat->floor = $validated['floor'];
        $flat->created_at = Carbon::now();

        $flat->save();
        return redirect()->back()->with('success', 'Flat registered successfully!');

    }

    public function edit($id)
    {
        $flat = Flat::findOrFail($id);
        $block = Block::get();
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
        $flat->floor = $request->input('floor');
  
        $flat->save();     
        return redirect()->route('flat.index')->with('success', 'Flat updated successfully!');
    }

    public function destroy($id)
    {
        $flat = Flat::findOrFail($id);
        $flat->delete();
        return response()->json(['success' => true]);
    }

    public function getFlats($blockId)
    {
        $flats = FlatArea::where('block', $blockId)->get();
        return response()->json($flats);
    }
    
}
