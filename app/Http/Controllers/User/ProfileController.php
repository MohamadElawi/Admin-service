<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\changePassword;
use App\Http\Requests\User\ProfileRequest;
use App\Http\Resources\User\ProfileResource;
use App\Http\Traits\HttpResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use HttpResponse ;
    public function getProfile(){
         $user =auth()->user();
        return self::returnData('profile',ProfileResource::make($user));
    }

    public function editUserName(ProfileRequest $request){
        $user=User::findOrFail(auth('user')->id());
        $user->user_name =$request->user_name ;
        $user->save();
        return self::success('name changed successfully');
    }

    public function changePassword(changePassword $request){
        $user =User::findOrFail(auth()->guard('user')->id());

        if( Hash::check($request->current_password,$user->password)){
            if($request->current_password == $request->new_password)
                return self::failure('new password and old password is matched',450);

            $user->password =Hash::make($request->new_password);
            $user->save();
            return self::success('password changed successfully');

        }else
                return self::failure('current password not correct',450);
    }

}
