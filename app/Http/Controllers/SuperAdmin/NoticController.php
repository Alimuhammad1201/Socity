<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sadmin\Notic;

class NoticController extends Controller
{
    public function index()
    {
        $notic = Notic::get();
        return view('superadmin.notic.index', compact('notic'));
    }
     
    public function store(Request $req)
    {
        $fileName = null;
        if($req->hasFile('image')){
            $file = $req->file('image');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/notice', $fileName);
        }
        Notic::create([
            'title' => $req->message,
            'image' => $fileName,
        ]);
        return redirect()->back();
    }

    public function update(Request $request)
{
    // Validate incoming request
   $validatedata =  $request->validate([
        'id' => 'required|exists:notice,id',
        'title' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|', // Image validation
    ]);

    // Find the existing notice record by ID
    $notice = Notic::findOrFail($validatedata['id']);

    // Handle file upload if there is a new image
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($notice->image && file_exists(public_path('uploads/notice/' . $notice->image))) {
            unlink(public_path('uploads/notice/' . $notice->image));
        }

        // Upload new image
        $file = $request->file('image');
        $fileName = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/notice'), $fileName);

        // Update the image path in the database
        $notice->image = $fileName;
    }

    // Update the title in the database
    $notice->title = $request->input('title');
    
    // Save the updated record
    $notice->save();

    // Redirect back with success message
    return redirect()->route('manage.notice')->with('success', 'Notice updated successfully.');
}

public function destroy($id)
{
    $notic = Notic::find($id);
    
    if ($notic) {
        // Delete the associated image file if it exists
        if ($notic->image) {
            $imagePath = public_path('uploads/notice/' . $notic->image);
            
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the file
            }
        }

        // Delete the record from the database
        $notic->delete();

        return redirect()->route('manage.notic')->with('success', 'Record and image deleted successfully.');
    } else {
        return redirect()->route('manage.notic')->with('error', 'Record not found.');
    }
}

public function view_user_notic()
{
    $notic = Notic::get();
    return view('user.notic.view', compact('notic'));
}

}
