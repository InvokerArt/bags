<?php

namespace App\Http\Requests\Backend\Comments;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreOrUpdateRequest extends FormRequest
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
            'news_id' => 'required',
            'is_blocked' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'content.required' => '评论内容不能为空',
            'user_id.required' => '用户不能为空',
            'topic_id.required' => '新闻不能为空'
        ];
    }
}
