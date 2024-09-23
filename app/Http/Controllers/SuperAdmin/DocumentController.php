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
        $documents = ResidentDocument::with('allotment')->get();
        return view('superadmin.resident_document.index', compact('documents'));
    }

    public function create()
    {
        $allotments = Allotment::get();
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
        ResidentDocument::create([
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
