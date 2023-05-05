<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index(){
        $breadcrumbs = [
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['name' => "admins"]
        ];

        return view('admin.admins.index', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function getData(){
        $admin =auth()->guard('admin')->id();
        $admins =Admin::where('id','!=',$admin)->latest()->get();
        return DataTables::of($admins)
            ->addIndexColumn()
            ->make('true');
    }

    public function show(Admin $admin){
        return returnData('admin',$admin);
    }


    public function destroy(Admin $admin){
        $admin->delete();
        return success('deleted successfully');
    }
}
