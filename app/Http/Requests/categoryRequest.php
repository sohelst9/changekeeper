<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class categoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_name'=>'required|unique:categories',
            'category_image'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'category_name.required'=>'* Please Enter Your Category Name',
            'category_name.unique'=>'* This Category Name Already Exists..',
            'category_image.required'=>'* Please Select Your Category Image',
        ];
    }
}
