<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Sadmin\Allotment;

class MainController extends Controller
{
    public function index()
    {
        if (Auth::guard('flat_guard')->check()) {
            $user = Auth::guard('flat_guard')->user();
//            dd(Allotment::with(['block', 'FlatArea'])->where('flat_id', $user->flat_id)->first());
            $allotments = Allotment::where('user_id', auth('flat_guard')->id())->with('block', 'allotFlats.flatArea')->first(); // replace '1' with an actual allotment_id
//            dd($allotment);
            return view('user.dashboard', compact('user', 'allotments'));
        } else {
            return redirect('/login');
        }
    }
}
