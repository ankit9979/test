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
            'product_name' => 'required',
            'product_desc' => 'required',
            'manufature_id' => 'required' ,
        ];
    }

    public function messages(){
        return [ 
            'product_name.required' => 'Please enter Product Name',
            'product_desc.required' => 'Please enter Product Description',
            'manufature_id.required' => 'Please choose manufacture one', ];
        }
    }
