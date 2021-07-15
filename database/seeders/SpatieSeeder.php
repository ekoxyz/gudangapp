<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SpatieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create permissions
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'crud role']);
        Permission::create(['name' => 'crud permission']);

        /**
         * Create Roles and give permissions
         */
        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo('create user');
        $role1->givePermissionTo('update user');
        $role1->givePermissionTo('delete user');
        $role1->givePermissionTo('crud role');
        $role1->givePermissionTo('crud permission');

        $role2 = Role::create(['name'=>'super-admin']);


        /**
         * create new user for super admin
         */
        $user = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'mexop71@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now(),
        ]);
        $user->assignRole($role2);
    }
}
