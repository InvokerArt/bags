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
            'mobile' => 'required|confirm_mobile_not_change|confirm_rule:check_mobile_unique',
            'verifyCode' => 'required|verify_code',
            'password' => 'required|min:6'
        ];
    }
}
