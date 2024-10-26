<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;

use App\Models\sadmin\Allotment;
use App\Models\Sadmin\ResidentDocument;
use Illuminate\Http\Request;
use App\Models\Sadmin\Document;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $documents = collect();
        if ($buildingAdmin) {
            $documents = ResidentDocument::where('building_admin_id', $buildingAdmin->id)->get();
        } else {
            $documents = ResidentDocument::where('user_id', $userId)->get();
        }

//        $documents = ResidentDocument::with('allotment')->get();
        return view('superadmin.resident_document.index', compact('documents'));
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
        return view('superadmin.resident_document.create', compact('allotments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'allotment_id' => 'required',
            'document_type' => 'required',
            'document_path' => 'required',
        ]);
        $path = null;
        if ($request->hasFile('document_path')) {
            $path = $request->file('document_path')->store('document_path', 'public');
        }

        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }

        ResidentDocument::create([
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),
            'allotment_id' => $request->allotment_id,
            'document_type' => $request->document_type,
            'document_path' => $path,
        ]);
        return redirect()->route('resident_document.index');
    }

    public function edit($id)
    {
        $allotments = Allotment::get();
        $documents = ResidentDocument::findOrFail($id);
        return view('superadmin.resident_document.edit', compact('allotments', 'documents'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'allotment_id' => 'required',
            'document_type' => 'required',
        ]);

        $residentDocument = ResidentDocument::findOrFail($id);

        if ($request->hasFile('document_path')) {

            $path = $request->file('document_path')->store('document_path', 'public');


            $residentDocument->update([
                'allotment_id' => $request->allotment_id,
                'document_type' => $request->document_type,
                'document_path' => $path,
            ]);
        } else {
            $residentDocument->update([
                'allotment_id' => $request->allotment_id,
                'document_type' => $request->document_type,
            ]);
        }
        return redirect()->route('resident_document.index');
    }
    public function destroy($id)
    {
        ResidentDocument::findOrFail($id)->delete();
        return redirect()->back();
    }
}
