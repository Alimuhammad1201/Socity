<?php

namespace App\Http\Controllers;

use App\Models\Sadmin\Block;
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

    public function getFlats($blockId)
    {
        $flats = FlatArea::where('block', $blockId)->get();
        return response()->json($flats);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'OwnerEmail' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('flat_guard')->attempt($credentials)) {
            return redirect()->intended('/user/dashboard');
        }

        return redirect()->back()->withErrors(['message' => 'Invalid credentials']);
    }
}
