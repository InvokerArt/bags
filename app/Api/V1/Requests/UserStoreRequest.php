<?php

namespace App\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'mobile' => 'confirm_rule:check_mobile_unique|confirm_mobile_not_change',
            'verifyCode' => 'required|verify_code',
            'password' => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'mobile.confirm_rule' => '手机号已存在'
        ];
    }
}
