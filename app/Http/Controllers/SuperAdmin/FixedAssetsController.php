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
        $assets = FixedAsset::get();
        return view('superadmin.fixed_assets.index', compact('assets'));
    }

    public function create()
    {
        $block = Block::get();
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

       FixedAsset::create([
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
        $block = Block::get();
        $assets = FixedAsset::findOrFail($id);
        $flat = FlatArea::get();
        return view('superadmin.fixed_assets.edit', compact('block', 'assets', 'flat'));
    }
}
