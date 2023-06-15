<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name_en'=>'required|string',
            'details_en'=>'required|string',
            'description_en'=>'required|string',
            'is_special'=>'in:0,1',
            'quantity'=>'required|numeric',
            'category_id'=>'required|numeric',
            'price'=>'required|numeric',
            'main_image'=>'required_without:_method|file|mimes:png,jpg,jpeg|max:4096',
            // 'images' => 'array|required|max:3',
            // 'images.*'=>'required|image|mimes:png,jpg,jpeg',
            'quantity_special_product' => 'lte:quantity|numeric' ,
        ];
    }

    public function messages()
    {
        return [
            'required_without' => 'The :attribute field is required.'
        ];
    }


}
