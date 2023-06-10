<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        DB::beginTransaction();
        Permission::create([
            'name' => 'view users',
            'guard_name' => 'admin',
            'description_en' => 'view users',
            'description_en' => 'view users',
            'category' => 'User Management'
        ]);

        Permission::create([
            'name' => 'create user',
            'guard_name' => 'admin',
            'description_en' => 'create user',
            'description_en' => 'create user',
            'category' => 'User Management'
        ]);

        Permission::create([
            'name' => 'edit user',
            'guard_name' => 'admin',
            'description_en' => 'edit user',
            'description_en' => 'edit user',
            'category' => 'User Management'
        ]);

        Permission::create([
            'name' => 'delete user',
            'guard_name' => 'admin',
            'description_en' => 'delete user',
            'description_en' => 'delete user',
            'category' => 'User Management'
        ]);

        Permission::create([
            'name' => 'view admins',
            'guard_name' => 'admin',
            'description_en' => 'view admins',
            'description_en' => 'view admins',
            'category' => 'Admin Management'
        ]);


        Permission::create([
            'name' => 'create admin',
            'guard_name' => 'admin',
            'description_en' => 'create admin',
            'description_en' => 'create admin',
            'category' => 'Admin Management'
        ]);


        Permission::create([
            'name' => 'delete admin',
            'guard_name' => 'admin',
            'description_en' => 'delete admin',
            'description_en' => 'delete admin',
            'category' => 'Admin Management'
        ]);

        Permission::create([
            'name' => 'view roles',
            'guard_name' => 'admin',
            'description_en' => 'view roles',
            'description_en' => 'view roles',
            'category' => 'Role Management'
        ]);


        Permission::create([
            'name' => 'create role',
            'guard_name' => 'admin',
            'description_en' => 'create role',
            'description_en' => 'create role',
            'category' => 'Role Management'
        ]);


        Permission::create([
            'name' => 'delete role',
            'guard_name' => 'admin',
            'description_en' => 'delete role',
            'description_en' => 'delete role',
            'category' => 'Role Management'
        ]);

        DB::commit();


        // $role = Role::where('name', 'user')->first();
        // $role->givePermissionTo('perm1');
        // $role->givePermissionTo('perm2');
    }
}
