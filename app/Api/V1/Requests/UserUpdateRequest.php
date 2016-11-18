<?php

namespace App\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;
use Auth;

class UserUpdateRequest extends FormRequest
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
            'username' => 'required',//required|alpha_dash_except_num|unique:users,username,'.Auth::id()
            'name' => 'required',
            'mobile' => 'required|is_mobile|unique:users,mobile,'.Auth::id(),
            'email' => 'required',
        ];
    }
}
