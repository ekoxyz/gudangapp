<?php

namespace App\Http\Controllers\Spatie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('security.permissions.index', compact('permissions'));
    }

    public function store()
    {
        request()->validate([
            'name' => 'required',
        ]);
        Permission::create([
            'name' => request('name'),
            'guard_name'=> request('guard_name') ?? 'web',
        ]);
        return back()->with('success', 'Berhasil Tambah Permission!');
    }
}
