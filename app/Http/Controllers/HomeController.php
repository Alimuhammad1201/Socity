<?php

namespace App\Http\Controllers;

use App\Models\sadmin\Allotment;
use App\Models\Sadmin\Block;
use App\Models\Sadmin\Complaints;
use App\Models\Sadmin\FlatArea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $blocks = Block::get();
        return view('welcome', compact('blocks'));
    }

    public function dashboard()
    {
        $total = Complaints::count();
        $flatareacount = FlatArea::count();
        $complaints_graph = Complaints::all();
        $resolved = Complaints::where('status', 'Resolved')->count();
        $allotmentscountrent = Allotment::where('status', 2)->count();
        $allotmentscountowner = Allotment::where('status', 1)->count();
        $unresolved = Complaints::where('status', 'Unresolved')->count();
        $inProgress = Complaints::where('status', 'In Progress')->count();
        $flatsWithoutAllotmentsCount = FlatArea::doesntHave('allotments')->count();
        $complaints = Complaints::with('complaintType')->orderBy('created_at', 'desc')->take(10)->get();
        return view('dashboard', compact('flatareacount', 'allotmentscountowner', 'allotmentscountrent', 'flatsWithoutAllotmentsCount', 'complaints', 'unresolved', 'inProgress', 'resolved', 'total', 'complaints_graph'));
    }

    public function getFlats($blockId)
    {
        $flats = FlatArea::where('block_id', $blockId)->get();
        return response()->json($flats);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'OwnerEmail' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('flat_guard')->attempt($credentials)) {
            return redirect()->intended('/user/dashboard');
        }

        return redirect()->back()->withErrors(['password' => 'Invalid password', 'email' => 'Invalid email']) ->withInput()
        ->with('form_id', $request->input('form_id', 'user'));;
    }
}
