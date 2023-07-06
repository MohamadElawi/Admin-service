<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Http\Resources\Admin\RoleResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view roles')->only('index', 'getData');
        $this->middleware('permission:create role')->only('create', 'store');
        $this->middleware('permission:edit role')->only('edit', 'update');
        $this->middleware('permission:change status role')->only('changeStatus');
        $this->middleware('permission:delete role')->only('destroy');
    }

    public function getData()
    {
        $roles = RoleResource::collection(Role::where('name', '!=', 'user')->get());
        return DataTables::of($roles)
            ->addIndexColumn()
            ->addColumn('action', 'admin.roles.action')
            ->make(true);
    }

    public function index()
    {
        $breadcrumbs = [
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['name' => "Roles"]
        ];
        return view('admin.roles.index', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function create()
    {
        $breadcrumbs = [
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['name' => "Roles", 'link' => '/Admin/dashboard'], ['name' => 'create role']
        ];
        $permissions = [];
        $data['admin_management'] = Permission::where('category', 'Admin Management')->get();
        $data['user_management'] = Permission::where('category', 'User Management')->get();
        $data['role_management'] = Permission::where('category', 'Role Management')->get();
        $data['category_management'] = Permission::where('category', 'Category Management')->get();
        $data['product_management'] = Permission::where('category', 'Product Management')->get();
        $data['service_management'] = Permission::where('category', 'Service Management')->get();
        $data['order_management'] = Permission::where('category', 'Order Management')->get();
        $data['maintenance_management'] = Permission::where('category', 'Maintenance Management')->get();
        return view('admin.roles.create', compact('breadcrumbs', 'data'));
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'admin'
        ]);

        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with(['success' => 'created successfully']);
    }

    public function edit(Role $role)
    {
        $breadcrumbs = [
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['name' => "Roles", 'link' => '/Admin/roles'], ['name' => 'edit role']
        ];
        $data['admin_management'] = Permission::where('category', 'Admin Management')->get();
        $data['user_management'] = Permission::where('category', 'User Management')->get();
        $data['role_management'] = Permission::where('category', 'Role Management')->get();
        $data['category_management'] = Permission::where('category', 'Category Management')->get();
        $data['product_management'] = Permission::where('category', 'Product Management')->get();
        $data['service_management'] = Permission::where('category', 'Service Management')->get();
        $data['maintenance_management'] = Permission::where('category', 'Maintenance Management')->get();
        $data['order_management'] = Permission::where('category', 'Order Management')->get();
        return view('admin.roles.edit', compact('data', 'role'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->update([$request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with(['success' => 'Updated successfully']);
    }

    public function changeStatus(Role $role)
    {
        $role->status = $role->status == 'active' ? 'notActive' : 'active';
        $role->save();
        return success('change status successfully');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return success('deleted successfully');
    }
}
