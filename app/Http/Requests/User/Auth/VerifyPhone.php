<?php

namespace App\Http\Requests\User\Auth;

use App\Http\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VerifyPhone extends FormRequest
{
    use HttpResponse ;
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // 'phone'=>'required|exists:users,phone',
            'email' => 'required|exists:users,email',
            'vcode'=>'required|digits:6'
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(Self::failure($validator->errors(),422));
    }
}
