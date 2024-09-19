<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return view('superadmin.documents.index', compact('documents'));
    }

    public function create()
    {
        return view('superadmin.documents.create');
    }


    public function edit($id)
    {
        $docs = Document::findOrFail($id);
        return view('superadmin.documents.edit', compact('docs'));
        
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'document_name' => 'required|string|max:255',
            'document_type' => 'required|string|max:255',
            'file_path' => 'nullable|file', // Make file upload optional
        ]);
        
        // Find the document record by ID
        $document = Document::find($id);
    
        if (!$document) {
            return redirect()->route('document.manage')->with('error', 'Document not found.');
        }
    
        // Handle file upload
        $fileName = $document->file_path; // Keep existing file if no new file is uploaded
        if ($request->hasFile('file_path')) {
            // Delete the old file if it exists
            if ($fileName && file_exists(public_path('uploads/documents/' . $fileName))) {
                unlink(public_path('uploads/documents/' . $fileName));
            }
    
            // Upload the new file
            $file = $request->file('file_path');
            $fileName = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/documents'), $fileName); // Use 'public' disk
        }
    
        // Update the document record
        $document->update([
            'document_name' => $request->input('document_name'),
            'document_type' => $request->input('document_type'),
            'file_path' => $fileName, // Store the new path to the file
            'uploaded_by' => auth()->user()->name,
        ]);
    
        return redirect()->route('document.manage')->with('success', 'Document updated successfully.');
    }
 
    // Validate the request
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'document_name' => 'required|string|max:255',
            'document_type' => 'required|string|max:255',
            'file_path' => 'required', // Ensure proper validation
        ]);
    
        // Handle file upload
        $fileName = null;
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $fileName = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
            $file->move('./uploads/documents', $fileName); // Use 'public' disk
        }
    
        // Create a new document record
        Document::create([
            'document_name' => $request->input('document_name'),
            'document_type' => $request->input('document_type'),
            'file_path' => $fileName, // Store the path to the file
            'uploaded_by' => auth()->user()->name,
        ]);
    
        return redirect()->route('document.manage')->with('success', 'Document uploaded successfully.');
    }

    public function destroy($id)
    {
        // Find the record by ID
       
    }
    


        
}
 $documents = Document::find($id);
    
        if ($documents) {
            // Delete the associated image file if it exists
            if ($documents->file_path) {
                $imagePath = public_path('uploads/documents/' . $documents->file_path);
                
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Delete the file
                }
            }
    
            // Delete the record from the database
            $documents->delete();
    
            return redirect()->route('document.manage')->with('success', 'Record and image deleted successfully.');
        } else {
            return redirect()->route('document.manage')->with('error', 'Record not found.');
        }