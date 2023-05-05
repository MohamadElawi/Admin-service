<?php

namespace App\Http\Requests\User\Auth;

use App\Http\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class changePassword extends FormRequest
{
    use HttpResponse ; 
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_password'=>'required|min:8|current_password:user',
            'new_password'=>'required|min:8',
            'confirm_password'=>'required|same:new_password',
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(Self::failure($validator->errors(),422));
    }
}
