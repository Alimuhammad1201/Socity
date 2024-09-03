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
            $allotments = Allotment::with(['block', 'FlatArea'])->where('flat_id', $user->flat_id)->first();
            return view('user.dashboard', compact('user', 'allotments'));
        } else {
    return redirect('/login');
}
    }
}
