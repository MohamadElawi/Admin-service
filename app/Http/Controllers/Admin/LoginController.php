<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function getLogin(){
        return view('admin.login');
    }


    public function login(LoginRequest $request)
    {
    //   $remember_me = $request->has('remember') ? 1 : 0 ;
      $remember_me =  0 ;
      $credentials = $request->only('email', 'password');
      $token = Auth::guard('admin')->attempt($credentials,$remember_me);
        if (!$token ) {
            return redirect()->back()->with(['error'=>'error']);
        }
      $admin=auth('admin')->user();
      $token =auth('admin-api')->attempt($credentials);
      Session::put('token',$token);
      return redirect()->route('dashboard');
    }

    public function logout()
    {
        $user = auth()->guard('admin')->logout();
        Session::forget('token');
        return redirect()->route('admin.getlogin')->with(['success'=>'logged out successfullly']);
    }


    public function dashboard()
    {
      $pageConfigs = ['pageHeader' => false];

      return view('content/dashboard/dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
    }
}
