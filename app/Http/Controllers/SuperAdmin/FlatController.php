<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Block;
use App\Models\Sadmin\Flat;
use App\Models\Sadmin\FlatArea;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    public function index()
    {
        $flats = Flat::with(['block', 'flatArea'])->get();
        return view('superadmin.Flat.index', compact('flats'));
    }

    public function create()
    {
       
        $block = Block::get();
        return view('superadmin.Flat.create', compact('block'));
    }

    public function store(Request $request)
    {
          $validated = $request->validate([
            'flat_no' => 'required|string|max:255',
            'block' => 'required|string|max:255',
            'floor' => 'required|string|max:255',    
        ]);
        $flat = new Flat();
        $flat->flat_id = $validated['flat_no'];
        $flat->block_id = $validated['block'];
        $flat->floor = $validated['floor'];
        
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
     
        $flat->flat_id = $request->input('flat_no');
        $flat->block_id = $request->input('block');
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
}
