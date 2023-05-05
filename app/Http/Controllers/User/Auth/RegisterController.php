<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Http\Requests\User\Auth\ResendCode;
use App\Http\Requests\User\Auth\VerifyPhone;
use App\Http\Traits\HttpResponse;
use App\Jobs\SendVerificationCode;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use HttpResponse;

    public function register(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'user_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'Vcode' => rand(111111, 999999),
            ]);

            $user->assignRole('user');
            // dispatch(new SendVerificationCode($user));
            DB::commit();
            return self::success('Account successfully created');
        } catch (\Exception $ex) {
            DB::rollBack();
            return self::failure($ex->getMessage(), 450);
        }
    }

    public function verifyPhoneNumber(VerifyPhone $request)
    {
        $user = User::where('phone', $request->phone)->first();
        if (!$user)
            abort(404);

        if ($user->Vcode == $request->vcode && $user->email_verified_at) {
            return self::failure('email already verified', 413);
        } elseif ($user->Vcode == $request->vcode) {
            $user->status = 'active';
            $user->email_verified_at = now();
            $user->save();
            return self::success('email verified successfully');
        } else {
            return self::failure('code is not correct', 414);
        }
    }

    public function resendCode(ResendCode $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->Vcode = rand(111111, 999999);
        $user->save();
        // dispatch(new SendVerificationCode($user));
        return self::success('resend code done successfully');
    }
}
