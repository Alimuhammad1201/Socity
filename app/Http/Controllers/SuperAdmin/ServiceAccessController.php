<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\sadmin\Allotment;
use App\Models\Sadmin\ServiceAccess;
use Illuminate\Http\Request;

class ServiceAccessController extends Controller
{
    public function index()
    {
        $services = ServiceAccess::with('allotment')->get();
        return view('superadmin.service_access.index',compact('services'));
    }
    public function create()
    {
        $allotments = Allotment::get();
        return view('superadmin.service_access.create',compact('allotments'));
    }
    public function store(Request $request)
    {
        $request->validate([
           'allotment_id' => 'required',
           'service_name' => 'required',
           'access_status' => 'required',
           'reason' => 'required',
        ]);

        ServiceAccess::create([
           'allotment_id' => $request->allotment_id,
           'service_name' => $request->service_name,
           'access_status' => $request->access_status,
           'reason' => $request->reason,
        ]);
        return redirect()->route('service_access.index');
    }

    public function edit($id)
    {
        $allotments = Allotment::get();
        $services = ServiceAccess::findOrFail($id);
        return view('superadmin.service_access.edit',compact('services','allotments'));
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
    public  function destroy($id)
    {
        ServiceAccess::findOrFail($id)->delete();
        return redirect()->back();
    }

}
