<?php

namespace App\Http\Requests\Backend\Products;

use App\Http\Requests\Request;

class ProductStoreOrUpdateRequest extends Request
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
            'title' => 'required',
            //'slug' => 'required|alpha_dash',
            'price' => 'required',
            'unit' => 'required',
            'images' => 'required',
            'content' => 'required'
        ];
    }
}
