<?php

namespace App\Http\Requests\User;

use App\Http\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProfileRequest extends FormRequest
{
    use HttpResponse ;
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_name'=>'required|max:50' ,
        ];
    }
    
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(Self::failure($validator->errors(),422));
    }
}
