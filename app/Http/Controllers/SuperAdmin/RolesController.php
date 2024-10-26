<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Employees;
use App\Models\Sadmin\Permission;
use App\Models\Sadmin\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Roles::where('user_id',auth()->id())->get();
        return view('superadmin.roles.index',compact('roles'));
    }

    public function create()
    {
        $employees = Employees::where('user_id',auth()->id())->get();
        $permissions = Permission::where('user_id',auth()->id())->get();
        return view('superadmin.roles.create',compact('employees','permissions'));
    }

public function store(Request $request)
{
    $request->validate([
        'role_name' => 'required',
        'permissions' => 'required|array',
        'permissions.*' => 'exists:permissions,id',
    ]);

    // Get selected permissions
    $selectedPermissions = $request->permissions;

    // Retrieve permissions from database
    $permissions = Permission::whereIn('id', $selectedPermissions)->get();

    // Store role with permissions as JSON
    Roles::create([
        'user_id' => auth()->user()->id,
        'role_name' => $request->role_name,
        'permissions' => $permissions->mapWithKeys(function($permission) {
            return [$permission->id => $permission->name];
        })->toArray(),
    ]);

    return redirect()->route('role.index')->with('success', 'Role created successfully.');
}
    public function edit($id)
    {
        $roles = Roles::where('user_id',auth()->id())->findOrFail($id); // Use $role instead of $roles
        $permissions = Permission::all();
//        dd($roles);
        return view('superadmin.roles.edit',compact('roles','permissions'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'role_name' => 'required',
            'permissions' => 'required',
        ]);

        Roles::where('user_id',auth()->id())->findOrFail($id)->update([
            'role_name' => $request->role_name,
            'permissions' => $request->permissions,
        ]);
        return redirect()->route('role.index');
    }

    public function destroy($id)
    {
        Roles::where('user_id',auth()->id())->findOrFail($id)->delete();
        return redirect()->back();
    }
}
