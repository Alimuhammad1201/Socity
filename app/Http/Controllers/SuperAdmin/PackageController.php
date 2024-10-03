<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Packages;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Packages::all();
        return view('frontend.package',compact('packages'));
    }
    public function backendindex()
    {
        $packages = Packages::all();
        return view('superadmin.package.index',compact('packages'));
    }
    public function subscribe($id)
    {
        $subscribe = Packages::findOrFail($id);
        return view('frontend.user-info',compact('subscribe'));
    }

    public function create()
    {
        return view('superadmin.package.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'features' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
        ]);

        $features = implode(',', $request->features);

        Packages::create([
            'name' => $request->name,
            'features' => $features,
            'price' => $request->price,
            'duration' => $request->duration,
        ]);
        return redirect()->route('packages.backendindex')->with('success', 'Package created successfully.');
    }
    public function edit($id)
    {
        $packages = Packages::findOrFail($id);
        return view('superadmin.package.edit',compact('packages'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'features' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
        ]);

        $features = array_filter($request->features, function($feature) {
            return !empty($feature);
        });

        $featuresString = implode(',', $features);

        Packages::findOrFail($id)->update([
            'name' => $request->name,
            'features' => $featuresString,
            'price' => $request->price,
            'duration' => $request->duration,
        ]);
        return redirect()->route('packages.backendindex')->with('success', 'Package created successfully.');
    }
}
