<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperAdmin;
use App\Models\Admin;
use App\Models\FlatUser;
use App\Models\Security;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function showloginform()
    {
        return view('Auth.login');
    }

    public function Showregister()
    {
        return view ('Auth.register');
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'superadmin_email' => 'required|email|unique:super_admins,email',
            'superadmin_password' => 'required|min:6',
            'superadmin_confirm_password' => 'required|same:superadmin_password',
        ]);

        // Create new SuperAdmin instance
       SuperAdmin::create([
            'email' => $validatedData['superadmin_email'],
            'password' => bcrypt($validatedData['superadmin_password']),
        ]);

        // Optionally, you can log in the user or redirect them to a login page
        // after successful registration.

        return redirect()->route('login')->with('success', 'Super Admin registered successfully.');
    }

    

 
}

