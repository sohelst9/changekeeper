<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'product_name'=>'required',
            'product_price'=>'required',
            'quantity'=>'required',
            'short_discription'=>'required',
            'long_discription'=>'required',
            'preview_image'=>'required',

        ];
    }

    public function messages()
    {
        return [
            'category_id.required'=>'* Please Select Your Category.',
            'subcategory_id.required'=>'* Please Select Your SubCategory.',
            'product_name.required'=>'* Please Enter Your Product Name.',
            'product_price.required'=>'* Please Enter Your Product Price.',
            'quantity.required'=>'* Please Enter Your Product Quantity.',
            'short_discription.required'=>'* Please Enter Product Short Description.',
            'long_discription.required'=>'* Please Enter Product Long Description.',
            'preview_image.required'=>'Slect Your Product preview Image.',

        ];
    }
}
