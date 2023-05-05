<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        Permission::create(['name'=>'perm1','guard_name'=>'user']);
        Permission::create(['name'=>'perm2','guard_name'=>'user']);
        Permission::create(['name'=>'perm3','guard_name'=>'user']);

        $role =Role::where('name','user')->first();
        $role->givePermissionTo('perm1');
        $role->givePermissionTo('perm2');

    }
}
