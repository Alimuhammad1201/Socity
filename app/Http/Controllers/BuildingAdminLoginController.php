<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class BuildingAdminLoginController extends Controller
{
    public function AdminDashboard()
    {
        if (!auth()->guard('building_admin')->check()) {
            return redirect()->route('building_admin.login');
        }

        $user = auth()->guard('building_admin')->user();
        $features = explode(',', $user->feature);
//        dd($user, $features);
        return view('admin.dashboard',compact('features'));
    }

    public function AdminLogin(Request $request)
    {

        if (Auth::guard('building_admin')->attempt([
            'email' => $request->input('b_email'),
            'password' => $request->input('b_password')
        ])) {
            return redirect()->route('building_admin.dashboard');
        } else {
            return redirect()->back()->withErrors([
                'b_password' => 'Invalid password',
                'b_email' => 'Invalid email'
            ])->withInput()->with('form_id', 'building_admin');
        }
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('building_admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
