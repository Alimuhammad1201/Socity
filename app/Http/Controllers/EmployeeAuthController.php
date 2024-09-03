<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('employee_email', 'employee_password');

        if (Auth::guard('employee_guard')->attempt(['email' => $credentials['employee_email'], 'password' => $credentials['employee_password']])) {
            // Agar login successful hota hai
            return redirect()->intended('/employee/dashboard');
        } else {
            // Agar login fail hota hai
            return back()->withErrors(['login_error' => 'Invalid credentials']);
        }
    }
}