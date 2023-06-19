<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $arr = [];
        DB::beginTransaction();
        /////////////// user management
        $arr['1'] = Permission::create([
            'name' => 'view users',
            'guard_name' => 'admin',
            'description_en' => 'view users',
            'description_ar' => 'view users',
            'category' => 'User Management'
        ]);

        $arr['2'] = Permission::create([
            'name' => 'create user',
            'guard_name' => 'admin',
            'description_en' => 'create user',
            'description_ar' => 'create user',
            'category' => 'User Management'
        ]);

        $arr['33'] = Permission::create([
            'name' => 'block user',
            'guard_name' => 'admin',
            'description_en' => 'block user',
            'description_ar' => 'block user',
            'category' => 'User Management'
        ]);

        $arr['3'] = Permission::create([
            'name' => 'edit user',
            'guard_name' => 'admin',
            'description_en' => 'edit user',
            'description_ar' => 'edit user',
            'category' => 'User Management'
        ]);

        $arr['4'] = Permission::create([
            'name' => 'delete user',
            'guard_name' => 'admin',
            'description_en' => 'delete user',
            'description_ar' => 'delete user',
            'category' => 'User Management'
        ]);

        ///////////// admin management
        $arr['4'] = Permission::create([
            'name' => 'view admins',
            'guard_name' => 'admin',
            'description_en' => 'view admins',
            'description_ar' => 'view admins',
            'category' => 'Admin Management'
        ]);


        $arr['5'] = Permission::create([
            'name' => 'create admin',
            'guard_name' => 'admin',
            'description_en' => 'create admin',
            'description_ar' => 'create admin',
            'category' => 'Admin Management'
        ]);

        $arr['6'] = Permission::create([
            'name' => 'change status admin',
            'guard_name' => 'admin',
            'description_en' => 'change status admin',
            'description_ar' => 'change status admin',
            'category' => 'Admin Management'
        ]);

        $arr['7'] = Permission::create([
            'name' => 'edit admin',
            'guard_name' => 'admin',
            'description_en' => 'edit admin',
            'description_ar' => 'edit admin',
            'category' => 'Admin Management'
        ]);

        $arr['8'] = Permission::create([
            'name' => 'delete admin',
            'guard_name' => 'admin',
            'description_en' => 'delete admin',
            'description_ar' => 'delete admin',
            'category' => 'Admin Management'
        ]);

        ////////////////// Role management
        $arr['9'] = Permission::create([
            'name' => 'view roles',
            'guard_name' => 'admin',
            'description_en' => 'view roles',
            'description_ar' => 'view roles',
            'category' => 'Role Management'
        ]);


        $arr['10'] = Permission::create([
            'name' => 'create role',
            'guard_name' => 'admin',
            'description_en' => 'create role',
            'description_ar' => 'create role',
            'category' => 'Role Management'
        ]);

        $arr['11'] = Permission::create([
            'name' => 'change status role',
            'guard_name' => 'admin',
            'description_en' => 'change status role',
            'description_ar' => 'change status role',
            'category' => 'Role Management'
        ]);

        $arr['12'] = Permission::create([
            'name' => 'edit role',
            'guard_name' => 'admin',
            'description_en' => 'edit role',
            'description_ar' => 'edit role',
            'category' => 'Role Management'
        ]);


        $arr['13'] = Permission::create([
            'name' => 'delete role',
            'guard_name' => 'admin',
            'description_en' => 'delete role',
            'description_ar' => 'delete role',
            'category' => 'Role Management'
        ]);

        /////////////// Category management

        $arr['14'] = Permission::create([
            'name' => 'view category',
            'guard_name' => 'admin',
            'description_en' => 'view category',
            'description_ar' => 'view category',
            'category' => 'Category Management'
        ]);

        $arr['15'] = Permission::create([
            'name' => 'create category',
            'guard_name' => 'admin',
            'description_en' => 'create category',
            'description_ar' => 'create category',
            'category' => 'Category Management'
        ]);

        $arr['16'] = Permission::create([
            'name' => 'edit category',
            'guard_name' => 'admin',
            'description_en' => 'edit category',
            'description_ar' => 'edit category',
            'category' => 'Category Management'
        ]);

        $arr['17'] = Permission::create([
            'name' => 'change status category',
            'guard_name' => 'admin',
            'description_en' => 'change status category',
            'description_ar' => 'change status category',
            'category' => 'Category Management'
        ]);

        $arr['18'] = Permission::create([
            'name' => 'delete category',
            'guard_name' => 'admin',
            'description_en' => 'delete category',
            'description_ar' => 'delete category',
            'category' => 'Category Management'
        ]);

        /////////////// product management

        $arr['19'] = Permission::create([
            'name' => 'view product',
            'guard_name' => 'admin',
            'description_en' => 'view product',
            'description_ar' => 'view product',
            'category' => 'Product Management'
        ]);

        $arr['20'] = Permission::create([
            'name' => 'create product',
            'guard_name' => 'admin',
            'description_en' => 'create product',
            'description_ar' => 'create product',
            'category' => 'Product Management'
        ]);

        $arr['21'] = Permission::create([
            'name' => 'edit product',
            'guard_name' => 'admin',
            'description_en' => 'edit product',
            'description_ar' => 'edit product',
            'category' => 'Product Management'
        ]);

        $arr['22'] = Permission::create([
            'name' => 'change status product',
            'guard_name' => 'admin',
            'description_en' => 'change status product',
            'description_ar' => 'change status product',
            'category' => 'Product Management'
        ]);

        $arr['23'] = Permission::create([
            'name' => 'delete product',
            'guard_name' => 'admin',
            'description_en' => 'delete product',
            'description_ar' => 'delete product',
            'category' => 'Product Management'
        ]);

        /////////// order management


        $arr['24'] = Permission::create([
            'name' => 'view order',
            'guard_name' => 'admin',
            'description_en' => 'view order',
            'description_ar' => 'view order',
            'category' => 'Order Management'
        ]);

        $arr['25'] = Permission::create([
            'name' => 'view order item',
            'guard_name' => 'admin',
            'description_en' => 'view order item',
            'description_ar' => 'view order item',
            'category' => 'Order Management'
        ]);


        ///////////  service manageemnt

        $arr['26'] = Permission::create([
            'name' => 'view service',
            'guard_name' => 'admin',
            'description_en' => 'view service',
            'description_ar' => 'view service',
            'category' => 'Service Management'
        ]);

        $arr['27'] = Permission::create([
            'name' => 'create service',
            'guard_name' => 'admin',
            'description_en' => 'create service',
            'description_ar' => 'create service',
            'category' => 'Service Management'
        ]);

        $arr['28'] = Permission::create([
            'name' => 'edit service',
            'guard_name' => 'admin',
            'description_en' => 'edit service',
            'description_ar' => 'edit service',
            'category' => 'Service Management'
        ]);

        $arr['29'] = Permission::create([
            'name' => 'change status service',
            'guard_name' => 'admin',
            'description_en' => 'change status service',
            'description_ar' => 'change status service',
            'category' => 'Service Management'
        ]);

        $arr['30'] = Permission::create([
            'name' => 'delete service',
            'guard_name' => 'admin',
            'description_en' => 'delete service',
            'description_ar' => 'delete service',
            'category' => 'Service Management'
        ]);


        ///////// maintenanace management 

        $arr['31'] = Permission::create([
            'name' => 'view maintenance',
            'guard_name' => 'admin',
            'description_en' => 'view maintenance',
            'description_ar' => 'view maintenance',
            'category' => 'Maintenance Management'
        ]);

        $arr['32'] = Permission::create([
            'name' => 'action maintenance',
            'guard_name' => 'admin',
            'description_en' => 'action maintenance',
            'description_ar' => 'action maintenance',
            'category' => 'Maintenance Management'
        ]);
        $role =Role::where('name','superAdmin')->first();
        foreach($arr as $permission)
            $role->givePermissionTo($permission);

        $admins = Admin::where('type','superAdmin')->get();
        foreach($admins as $admin){
            $admin->assignRole($role);
        }
        DB::commit();


        // $role = Role::where('name', 'user')->first();
        // $role->givePermissionTo('perm1');
        // $role->givePermissionTo('perm2');
    }
}
