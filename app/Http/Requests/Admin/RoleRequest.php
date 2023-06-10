<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'=>['required','max:50', Rule::unique('roles','name')->ignore($this->role)],
            'permissions'=>'required|array',
            'permissions.*'=>'exists:permissions,id'
        ];
    }
}
