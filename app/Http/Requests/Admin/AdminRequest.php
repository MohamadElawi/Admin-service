<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'email' => ['required', 'email', Rule::unique('admins', 'email')->ignore($this->admin)],
            'phone' => 'required|numeric|digits:10',
            'password' => 'required_without:_method|min:6|string',
            'type' => 'required|in:admin,superAdmin',
            'role' => 'required|exists:roles,id',
        ];
    }


    public function failedValidation(Validator $validator)
    {
        // dd(request()->method());
        if (request()->method() == 'PUT') {
            // throw new HttpResponseException(response()->json(['errors'=>$validator->errors()],422));
        } else {
            $response = redirect()->back()
                ->withInput($this->input())
                ->withErrors($validator->errors()->getMessages());

            throw new \Illuminate\Validation\ValidationException($validator, $response);
        }
    }
}
