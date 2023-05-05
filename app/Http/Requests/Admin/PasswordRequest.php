<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password'=>'required:min:8',
            'new_password'=>'required|min:8',
            'password_confirmation'=>'required|min:8|same:new_password',
        ];
    }

}
