<?php

namespace App\Http\Requests\Admin;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'user_name'=>'required|string|max:50' ,
            'email'=>['required','email',Rule::unique('users','email')->ignore($this->user)],
            'phone' => 'required|numeric|digits:10',
            'password'=>'required_without:_method|min:6|string',
            'address'=>'required',
            'gender'=>'required|in:male,female',
        ];
    }

    public function messages()
    {
        return [
            'required_without'=>'The :attribute field is required.',
        ];
    }

    public function failedValidation(Validator $validator){
        // if($this->$request->ajax()){

        }


}
