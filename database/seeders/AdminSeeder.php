<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $admin = Admin::create([
            'name'=>'admin' ,
            'email'=>'email@gmail.com',
            'password'=>Hash::make('123456789'),
            'phone'=>'1234564871' ,
        ]);

        $admin->assignRole('admin');
    }
}
