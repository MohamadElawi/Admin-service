<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PasswordRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profileShow()
    {
        $breadcrumbs = [
            ['link' => "/dashboard", 'name' => "Home"], ['link' => "users", 'name' => "user"], ['name' => 'profile']
        ];
        $user = Auth::guard('admin')->user();
        return view('profile.show', compact('breadcrumbs', 'user'));
    }

    public function editProfile(Request $request)
    {
        $user_id = Auth::guard('admin')->user()->id;
        $user = Admin::find($user_id);

        $validator =Validator::make($request->all(),[
            'name'=>'required|min:3|max:30',
            'email'=>"required|email|unique:admins,email,$user->id"
        ]);
        if($validator->fails())
            return redirect()->back()->withErrors($validator) ;

        $user->update([
            'user_name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
        return redirect()->route('profile.show')->with(['success' => 'profile updated successfully']);
    }

    public function editPassword(PasswordRequest $request)
    {

        $user_id = Auth::guard('admin')->user()->id;
        $user = Admin::find($user_id);
        if (!Hash::check($request->password, $user->password))
            return redirect()->route('profile.show')->with(['error-pass' => 'current password not correct']);

        elseif ($request->password == $request->new_password)
            return redirect()->route('profile.show')->with(['error-pass' => 'current password and new password ']);


        $user->update([
            'password' => Hash::make($request->input('new_password')),
        ]);
        return redirect()->route('profile.show')->with(['success-pass' => 'password updated successfully']);
    }
}
