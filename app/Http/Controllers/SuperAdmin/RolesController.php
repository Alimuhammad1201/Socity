<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Employees;
use App\Models\Sadmin\Permission;
use App\Models\Sadmin\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Roles::get();
        return view('superadmin.roles.index',compact('roles'));
    }

    public function create()
    {
        $employees = Employees::get();
        $permissions = Permission::get();
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
        'role_name' => $request->role_name,
        'permissions' => $permissions->mapWithKeys(function($permission) {
            return [$permission->id => $permission->name];
        })->toArray(),
    ]);

    return redirect()->route('role.index')->with('success', 'Role created successfully.');
}
    public function edit($id)
    {
        $roles = Roles::findOrFail($id); // Use $role instead of $roles
        $permissions = Permission::all();
        dd($roles);
        return view('superadmin.roles.edit',compact('roles','permissions'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'role_name' => 'required',
            'permissions' => 'required',
        ]);

        Roles::findOrFail($id)->update([
            'role_name' => $request->role_name,
            'permissions' => $request->permissions,
        ]);
        return redirect()->route('role.index');
    }

    public function destroy($id)
    {
        Roles::findOrFail($id)->delete();
        return redirect()->back();
    }
}
