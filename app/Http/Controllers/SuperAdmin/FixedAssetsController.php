<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\sadmin\FixedAsset;
use App\Models\sadmin\Block;
use App\Models\Sadmin\FlatArea;
use Illuminate\Http\Request;

class FixedAssetsController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $assets = collect();
        if ($buildingAdmin) {
            $assets = FixedAsset::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $assets = FixedAsset::where('user_id', $userId)->get();
        }
//        $assets = FixedAsset::get();
        return view('superadmin.fixed_assets.index', compact('assets'));
    }

    public function create()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $block = collect();
        if ($buildingAdmin) {
            $block = Block::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $block = Block::where('user_id', $userId)->get();
        }
//        $block = Block::where('user_id',auth()->id())->get();
        return view('superadmin.fixed_assets.create', compact('block'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'assets_name' => 'required|string',
            'block' => 'required',
            'flat_no' => 'required',
            'location' => 'required',
            'purchase_date' => 'required|date',
            'status' => 'required'
        ]);
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }
        FixedAsset::create([
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),
            'asset_name' => $req->assets_name,
            'block_id' => $req->block,
            'flat_id' => $req->flat_no,
            'location' => $req->location,
            'assigned_user' => $req->assgiend_user,
            'purchase_date' => $req->purchase_date,
            'status' => $req->status,
        ]);
        return redirect()->route('assets.index');
    }

    public function edit($id)
    {
        $block = Block::where('user_id', auth()->id())->get();
        $assets = FixedAsset::where('user_id', auth()->id())->findOrFail($id);
        $flat = FlatArea::where('user_id', auth()->id())->get();
        return view('superadmin.fixed_assets.edit', compact('block', 'assets', 'flat'));
    }
}
