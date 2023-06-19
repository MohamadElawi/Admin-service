<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{

    public function run()
    {
        Role::create(['name'=>'superAdmin' ,'guard_name'=>'admin']);
        Role::create(['name'=>'Admin' ,'guard_name'=>'admin']);
        Role::create(['name'=>'user','guard_name'=>'user']);
    }
}
