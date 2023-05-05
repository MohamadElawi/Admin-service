<?php

namespace App\Http\Requests\User\Auth;

use App\Http\Traits\HttpResponse;
use Illuminate\Foundation\Http\FormRequest;

class ResendCode extends FormRequest
{
    use HttpResponse ;
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'=>'required|exists:users,email'
        ];
    }
}
