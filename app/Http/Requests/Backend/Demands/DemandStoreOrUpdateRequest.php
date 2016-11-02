<?php

namespace App\Http\Requests\Backend\Demands;

use App\Http\Requests\Request;

class DemandStoreOrUpdateRequest extends Request
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
            'user_id' => 'required',
            'title' => 'required',
            //'slug' => 'required|alpha_dash',
            'quantity' => 'required|integer',
            'unit' => 'required',
            'content' => 'required'
        ];
    }
}
