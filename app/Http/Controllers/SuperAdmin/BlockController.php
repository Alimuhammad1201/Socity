<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Building_Admin;
use Illuminate\Http\Request;
use App\Models\Sadmin\Block;

class BlockController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $blocks = collect();

        if ($buildingAdmin) {
            $blocks = Block::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $blocks = Block::where('user_id', $userId)->get();
        }
        return view('superadmin.block.index', compact('blocks'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'block' => 'required|string|max:255',
            'dynamic-fields.*' => 'nullable|string|max:255',
        ]);
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {
            // Retrieve the builder (user) ID from the building_admin table
            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }
//        dd($buildingAdmin);

        Block::create([
            'Block_name' => $validatedData['block'],
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),

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
