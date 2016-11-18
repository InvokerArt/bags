<?php

namespace App\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;

class JobStoreRequest extends FormRequest
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
            'job' => 'required',
            'total' => 'required',
            'education' => 'required',
            'experience' => 'required',
            'minsalary' => 'required',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'total.required' => '招聘人数'
        ];
    }
}
