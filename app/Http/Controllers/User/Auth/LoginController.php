<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\LoginRequest;
use App\Http\Traits\HttpResponse;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    use HttpResponse;

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);
        if (!$token) {
            return self::failure('Unauthorized', 401);
        }
        return  $user=auth()->guard('user')->user();
        //  return  User::latest()->first();
         $user->token = $token ;

        return self::returnData('user', $user);
    }

    public function logout()
    {
        // dd($user = auth()->guard('user')->user());
        $user = auth()->logout();
        // if (!$user) {
            //     return response()->json(['message' => "The token is invalid"], 400);
        return self::success('logged out successfully');
    }
}
