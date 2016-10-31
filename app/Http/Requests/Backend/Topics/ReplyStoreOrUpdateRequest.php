<?php

namespace App\Http\Requests\Backend\Topics;

use Illuminate\Foundation\Http\FormRequest;

class ReplyStoreOrUpdateRequest extends FormRequest
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
            'content' => 'required',
            'user_id' => 'required',
            'topic_id' => 'required',
            'is_blocked' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'content.required' => '回复内容不能为空',
            'user_id.required' => '用户不能为空',
            'topic_id.required' => '话题不能为空'
        ];
    }
}
