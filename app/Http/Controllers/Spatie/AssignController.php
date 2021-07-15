<?php

namespace App\Http\Controllers\Spatie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssignController extends Controller
{

    public function index()
    {
        $roles = Role::get();
        $roles2 = Role::doesntHave('permissions')->get();
        $permissions = Permission::all();
        return view('security.assign.index', compact('roles','roles2','permissions'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'permissions' => 'required|array'
        ]);
        $role = Role::findOrFail($request->role);
        $role->givePermissionTo($request->permissions);
        return back()->with('success', "Assign Success!! Role:{$role->name}");
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('security.assign.edit', compact('role','permissions'));
    }
    public function update(Role $role)
    {
        request()->validate([
            'role' => 'required',
        ]);
        $role->syncPermissions(request('permissions'));
        return redirect()->route('assign.index')->with('success', 'Sync Success!!!');
    }
}
