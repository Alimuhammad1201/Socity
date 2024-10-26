<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Building_Admin;
use App\Models\Sadmin\Packages;
use Illuminate\Support\Facades\Hash;
use App\Models\Sadmin\Subscription;
use Illuminate\Http\Request;

class Building_AdminController extends Controller
{



    public function index()
    {
        $building_admin = Building_Admin::where('user_id', auth()->id())->with('building')->get();
        return view('admin.building_admin.index', compact('building_admin'));
    }

    public function create()
    {
        $user_id = auth()->user()->id;
        $subscription = Subscription::with('package')->where('user_id', $user_id)->first();

        if ($subscription) {
            $package = $subscription->package;

            if ($package) {
                $package_feature = explode(',', $package->features);
                $assign_building = Building::where('user_id',auth()->id())->get();
                return view('admin.building_admin.create', compact('package_feature', 'assign_building'));
            } else {
                return redirect()->route('admin-building.index')->with('error', 'No Package Found');
            }
        } else {
            return redirect()->route('admin-building.index')->with('error', 'No Valid Package Found');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:building_admins,email', // Make sure the email is unique
        'password' => 'required|min:8', // Add minimum length for security
        'feature' => 'required',
        'assign_building' => 'required',
    ]);
        $features = implode(',', $request->feature);

        Building_Admin::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
            'assign_building' => $request->assign_building,
            'feature' => $features,
        ]);

        return redirect()->route('admin-building.index');
    }
    public function edit($id)
    {
        {
            $user_id = auth()->user()->id;
            $subscription = Subscription::with('package')->where('user_id', $user_id)->first();

            if ($subscription) {
                $package = $subscription->package;

                if ($package) {
                    $package_feature = explode(',', $package->features);
                    $assign_building = Building::where('user_id',auth()->id())->get();
                    $building_admin = Building_Admin::with('building')->where('id', $id)->first();
                    return view('admin.building_admin.edit', compact('package_feature', 'assign_building','building_admin'));
                } else {
                    return redirect()->route('admin-building.index')->with('error', 'No Package Found');
                }
            } else {
                return redirect()->route('admin-building.index')->with('error', 'No Valid Package Found');
            }
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:building_admins,email,'.$id,
            'assign_building' => 'required',
        ]);

        $features = is_array($request->feature) ? array_filter($request->feature, function($feature) {
            return !empty($feature);
        }) : [];

        $featuresString = implode(',', $features);

        Building_Admin::findOrFail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'feature' => $featuresString,
            'password' => Hash::make($request->password),
            'assign_building' => $request->assign_building,
        ]);

        return redirect()->route('admin-building.index');

    }

    public function destroy($id)
    {
        Building_Admin::findOrFail($id)->delete();
        return redirect()->route('admin-building.index');
    }
}
