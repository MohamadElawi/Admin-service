<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Http\Traits\HttpResponse;
use App\Jobs\BlockedUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\Datatables;

class UserController extends Controller
{
    use HttpResponse;

    public function __construct()
    {
        $this->middleware('permission:view users')->only('index');
        $this->middleware('permission:create user')->only('create', 'store');
        $this->middleware('permission:edit user')->only('edit', 'update');
        $this->middleware('permission:block user')->only('blocked');
        $this->middleware('permission:delete user')->only('destroy', 'restore');
    }

    public function index()
    {
        // return auth('admin')->user();
        $breadcrumbs = [
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['name' => "users"]
        ];

        return view('admin.users.index', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }


    public function getData()
    {
        $users = User::withTrashed()->latest()->get();
        return Datatables::of($users)
            ->addColumn('action', 'admin.users.actions')
            ->addIndexColumn()
            ->make(true);
    }

    public function create()
    {
        $breadcrumbs = [
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['link' => '/Admin/users', 'name' => "users"]
        ];

        return view('admin.users.create', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }


    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        $data['status'] = 'active';
        $user = User::create($data);
        $user->assignRole('user');
        // return Self::success('created successfully');
        DB::commit();
        return redirect()->route('users.index')->with(['success' => 'created successfully']);
    }

    public function show($user_id)
    {
        $user = User::withTrashed()->findOrFail($user_id);
        $user = UserResource::make($user);
        return self::returnData('user', $user);
    }

    public function edit($id)
    {
        $breadcrumbs = [
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['link' => '/Admin/users', 'name' => "users"]
        ];

        return view('admin.users.edit', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);
        return response()->json('updated successfully');
    }


    public function destroy(User $user)
    {
        // maybe you should delete relations if exist
        $user->removeRole('user');
        $user->status = 'deleted';
        $user->save();
        $user->delete();
        return self::success('user deleted successfully');
    }

    public function restore($user_id)
    {
        $user = User::withTrashed()->whereNotNull('deleted_at')->findOrFail($user_id);
        $user->restore();
        $user->status = 'active';
        $user->save();
        return self::success('user restored successfully');
    }

    public function blocked(User $user)
    {
        $user->status == 'blocked' ? ($user->email_verified_at != null ? $user->status = 'active' : $user->status = 'notActive')
            : $user->status = 'blocked';
        $user->save();
        $message = $user->status == 'blocked' ? 'blocked' : 'unblocked';
        dispatch(new BlockedUser($user->toArray(), $message));
        return self::success("user $user->status successfully");
    }
}
