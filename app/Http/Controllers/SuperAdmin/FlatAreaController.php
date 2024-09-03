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
        $flatarea = FlatArea::get();
        return view('superadmin.flatarea.index', compact('flatarea'));
    }

    public function create()
    {
        $blocks = Block::all();
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

        $flatarea = new Flatarea();
        $flatarea->flat_no = $validated['flat_no'];
        $flatarea->block = $validated['block'];
        $flatarea->flat_type = $validated['flat_type'];
        $flatarea->flat_area = $validated['flat_area'];
        $flatarea->maintenance_rate = $validated['maintenance_rate'];

        $flatarea->save();
        return redirect()->back()->with('success', 'Flat Area registered successfully!');
     }

     public function edit($id)
     {
        $flat = Flatarea::find($id);
        $block = Block::get();
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
        $flat->flat_type = $request->input('flat_type');
        $flat->flat_area = $request->input('flat_area');
        $flat->maintenance_rate = $request->input('maintenance_rate');
        

        $flat->save();
    
     
        return redirect()->route('flatarea.index')->with('success', 'Flat area updated successfully!');
    }

    public function destroy($id)
    {
        $flat = Flatarea::findOrFail($id);
        $flat->delete();
        return response()->json(['success' => true]);
    }
    
  
}
