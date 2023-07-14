<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AdminExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view admins')->only('index');
        $this->middleware('permission:create admin')->only('create', 'store');
        $this->middleware('permission:edit admin')->only('update');
        $this->middleware('permission:change status admin')->only('changeStatus');
        $this->middleware('permission:delete admin')->only('destroy');
    }

    public function getData()
    {
        $admin = auth()->guard('admin')->id();
        $admins = Admin::where('id', '!=', $admin)->latest()->get();
        return DataTables::of($admins)
            ->addIndexColumn()
            ->addColumn('action', 'admin.admins.action')
            ->make('true');
    }

    public function index()
    {
        $breadcrumbs = [
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['name' => "categories"]
        ];
        $roles = Role::where('status', 'active')->get();

        return view('admin.admins.index', [
            'breadcrumbs' => $breadcrumbs,
            'roles' => $roles
        ]);
    }

    public function create()
    {
        $breadcrumbs = [
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['name' => "admins", 'link' => 'Admin/admins'], ['name' => 'Create Admin']
        ];

        $roles = Role::where('name', '!=', 'user')->where('status', 'active')->get();
        return view('admin.admins.create', compact('breadcrumbs', 'roles'));
    }

    public function store(AdminRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['password'] = Hash::make($request->password);
            $admin = Admin::create($data);
            $admin->assignRole($data['role']);
            DB::commit();
            return redirect()->route('admins.index')->with(['success' => 'admin created successfully']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admins.index')->with(['error' => 'some things went wrongs']);
        }
    }


    public function show(Admin $admin)
    {
        return returnData('admin', $admin);
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        $data = $request->validated();
        $admin->update($data);
        $role = Role::find($data['role']);
        $admin->syncRoles($role);
        return response()->json('updated successfully');
    }


    public function changeStatus(Admin $admin)
    {
        $admin->status = $admin->status == 'active' ? 'notActive' : 'active';
        $admin->save();
        return success('change status successfully');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return success('deleted successfully');
    }

    public function export(){
        $time = Carbon::now()->format('m_d_H:i');
        return Excel::download(new AdminExport() , "admin_$time.xlsx");
    }
}
