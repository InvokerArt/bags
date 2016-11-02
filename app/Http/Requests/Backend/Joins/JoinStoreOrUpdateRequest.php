<?php

namespace App\Http\Requests\Backend\Joins;

use Illuminate\Foundation\Http\FormRequest;

class JoinStoreOrUpdateRequest extends FormRequest
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
            'company_id' => 'required',
            'identity_card' => 'required',
            'licenses' => 'required',
        ];
    }
}
