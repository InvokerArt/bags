<?php

namespace App\Http\Requests\Backend\Topics;

use Illuminate\Foundation\Http\FormRequest;

class TopicStoreOrUpdateRequest extends FormRequest
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
            'content' => 'required',
            'user_id' => 'required',
            'is_excellent' => 'required',
            'is_blocked' => 'required',
            'category_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => '分类不能为空',
        ];
    }
}
