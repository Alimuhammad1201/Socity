<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\sadmin\Allotment;
use App\Models\Sadmin\Payroll;
use App\Models\Sadmin\ServiceAccess;
use Illuminate\Http\Request;

class ServiceAccessController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $services = collect();
        if ($buildingAdmin) {
            $services = ServiceAccess::where('building_admin_id', $buildingAdmin->id)->with(['allotment'])->get();
        } else {
            $services = ServiceAccess::where('user_id', $userId)->with(['allotment'])->get();
        }

//        $services = ServiceAccess::where('user_id',auth()->id())->with('allotment')->get();
        return view('superadmin.service_access.index', compact('services'));
    }

    public function create()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $allotments = collect();
        if ($buildingAdmin) {
            $allotments = Allotment::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $allotments = Allotment::where('user_id', $userId)->get();
        }

//        $allotments = Allotment::where('user_id',auth()->id())->get();
        return view('superadmin.service_access.create', compact('allotments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'allotment_id' => 'required',
            'service_name' => 'required',
            'access_status' => 'required',
            'reason' => 'required',
        ]);
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }

        ServiceAccess::create([
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),
            'allotment_id' => $request->allotment_id,
            'service_name' => $request->service_name,
            'access_status' => $request->access_status,
            'reason' => $request->reason,
        ]);
        return redirect()->route('service_access.index');
    }

    public function edit($id)
    {
        $allotments = Allotment::where('user_id',auth()->id())->get();
        $services = ServiceAccess::where('user_id',auth()->id())->findOrFail($id);
        return view('superadmin.service_access.edit', compact('services', 'allotments'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'allotment_id' => 'required',
            'service_name' => 'required',
            'access_status' => 'required',
            'reason' => 'required',
        ]);

        ServiceAccess::findOrFail($id)->update([
            'allotment_id' => $request->allotment_id,
            'service_name' => $request->service_name,
            'access_status' => $request->access_status,
            'reason' => $request->reason,
        ]);
        return redirect()->route('service_access.index');
    }

    public function destroy($id)
    {
        ServiceAccess::where('user_id',auth()->id())->findOrFail($id)->delete();
        return redirect()->back();
    }

}
