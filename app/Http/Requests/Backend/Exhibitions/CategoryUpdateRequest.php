<?php

namespace App\Http\Requests\Backend\Exhibitions;

use App\Http\Requests\Request;

class CategoryUpdateRequest extends Request
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
            'name' => 'required',
            'is_active' => 'required',
            'slug' => 'required|alpha_dash'
        ];
    }
}
