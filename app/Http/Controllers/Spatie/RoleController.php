<?php

namespace App\Http\Controllers\Spatie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('security.roles.index', compact('roles'));
    }

    public function store()
    {

        request()->validate([
            'name' => 'required',
        ]);

        Role::create([
            'name' => request('name'),
            'guard_name'=> request('guard_name') ?? 'web',
        ]);
        return back();
    }
}
