<?php

namespace App\Http\Requests\Backend\Supplies;

use App\Http\Requests\Request;

class SupplyStoreOrUpdateRequest extends Request
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
            'price' => 'required|numeric',
            'unit' => 'required',
            'images' => 'required',
            'content' => 'required'
        ];
    }
}
