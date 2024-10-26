<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
   public function index()
{
    $permissions = Permission::where('user_id',auth()->id())->all();
    return view('superadmin.permission.index', compact('permissions'));
}

public function create()
{
    return view('superadmin.permission.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:permissions',
    ]);

    Permission::create([
        'name' => $request->name,
        'user_id' => auth()->user()->id,
        'description' => $request->description,
    ]);

    return redirect()->route('permissions.index');
}

public function edit($id)
{
    $permission = Permission::where('user_id',auth()->id())->findOrFail($id);
    return view('superadmin.permission.edit', compact('permission'));
}

public function update(Request $request,$id)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:permissions',
    ]);

    Permission::findOrFail($id)->update([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    return redirect()->route('permissions.index');
}
public function destroy(Permission $permission, $id)
{
    $permission->findOrFail($id)->delete();
    return redirect()->route('permissions.index');
}
}
