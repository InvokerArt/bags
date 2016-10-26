<?php

namespace App\Http\Requests\Backend\Users;

use Illuminate\Foundation\Http\FormRequest;

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
            'username' => 'required|alpha_dash_except_num|unique:users,username,'.$this->route('user')->id,
            'mobile' => 'required|is_mobile|unique:users,mobile,'.$this->route('user')->id,
            'password' => 'min:6|confirmed',
        ];
    }
}
