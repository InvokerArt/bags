<?php

namespace App\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;

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
            'content' => 'required',
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
