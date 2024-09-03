<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sadmin\Block;

class BlockController extends Controller
{
    public function index()
    {
        $blocks = Block::get();
        return view('superadmin.block.index', compact('blocks'));
    }

  

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'block' => 'required|string|max:255',
            'dynamic-fields.*' => 'nullable|string|max:255',
        ]);


        Block::create([
            'Block_name' => $validatedData['block'],
        ]);

        return redirect()->route('block.index')->with('success', 'Block added successfully!');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:block,id',
            'block_name' => 'required|string|max:255',
        ]);

        $block = Block::findOrFail($validatedData['id']);
        $block->Block_name = $validatedData['block_name'];
        $block->save();

        return redirect()->route('block.index')->with('success', 'Block updated successfully!');
    }

    public function destroy($id)
    {
        $block = Block::findOrFail($id);
        $block->delete();
        return response()->json(['success' => true]);
    }

}
