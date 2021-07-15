<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        $roles = Role::get();
        return view('admin.users.index', compact('users', 'roles'));
        // return $users;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'roles' => 'required',
        ]);

        $newUser = new User();
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->password =Hash::make('12345678');
        $newUser->save();
        $newUser->assignRole($request->roles);
        event(new Registered($newUser));

        return back()->with('success', 'Tambah user berhasil!');

    }
    public function edit(User $user)
    {
        $roles = Role::get();
        return view('admin.users.edit', compact('user', 'roles'));
    }
    public function update(User $user)
    {
        $newData = request();
        $newData->validate([
            'name' => ['required','max:16']
        ]);
        $user->name = $newData->name;
        $user->update();
        $user->syncRoles($newData->roles);
        return redirect()->route('users.index')->with('success', 'Berhasil Update User!');
    }
}
