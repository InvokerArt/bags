<?php

namespace App\Http\Requests\Backend\Access\User;

use App\Http\Requests\Request;

class UserStoreOrUpdateRequest extends Request
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
            'user_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => '用户名必填'
        ];
    }
}
