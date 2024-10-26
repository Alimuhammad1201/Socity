<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Roles;
use App\Models\Sadmin\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use function Spatie\Ignition\ErrorPage\updateConfigEndpoint;

class UserRolesController extends Controller
{
    public function index()
    {
        $userrole = UserRole::with('user','roles')->get();
        return view('superadmin.user_role.index', compact('userrole'));
    }

    public function create()
    {
        $users = User::where('user_id',auth()->id())->get();
        $roles = Roles::where('user_id',auth()->id())->get();
        return view('superadmin.user_role.create', compact('users','roles'));
    }
    public function store(Request $request)
    {
        $request->validate([
           'user_id' => 'required',
           'role_id' => 'required',
        ]);
        UserRole::create([
           'user_id' => $request->user_id,
           'role_id' => $request->role_id,
        ]);
        return redirect()->route('user_role.index');
    }
    public function edit($id)
    {
        $users = User::where('user_id',auth()->id())->get();
        $roles = Roles::where('user_id',auth()->id())->get();
        $userrole = UserRole::where('user_id',auth()->id())->findOrFail($id);
        return view('superadmin.user_role.edit',compact('users','userrole','roles'));
    }
    public function update(Request $request ,$id)
    {
         $request->validate([
           'user_id' => 'required',
           'role_id' => 'required',
        ]);
        UserRole::findOrFail($id)->update([
           'user_id' => $request->user_id,
           'role_id' => $request->role_id,
        ]);
        return redirect()->route('user_role.index');
    }
    public function destroy($id)
    {
        UserRole::where('user_id',auth()->id())->findOrFail($id)->delete();
        return redirect()->back();
    }
}
