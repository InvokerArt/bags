<?php

namespace App\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;

class DemandStoreOrUpdateRequest extends FormRequest
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
            'quantity' => 'required|integer',
            'unit' => 'required',
            'content' => 'required',
            'images' => 'required'
        ];
    }
}
