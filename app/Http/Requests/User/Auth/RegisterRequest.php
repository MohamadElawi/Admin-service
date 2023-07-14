<?php

namespace App\Http\Requests\User\Auth;

use App\Http\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    use HttpResponse;
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'=>'required|string|max:50' ,
            'email'=>'required|email|unique:users,email',
            'phone' => 'required|numeric|digits:10|unique:users,phone',
            'password'=>'required|min:6|string',
            'address'=>'required',
            'confirm_password'=>'required|same:password',
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(Self::failure($validator->errors(),422));
    }
}
