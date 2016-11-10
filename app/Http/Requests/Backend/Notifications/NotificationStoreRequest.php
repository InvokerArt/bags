<?php

namespace App\Http\Requests\Backend\Notifications;

use Illuminate\Foundation\Http\FormRequest;

class NotificationStoreRequest extends FormRequest
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
            'data' => 'required',
            'notification_type' => 'required',
            'notification_id' => 'required',
        ];
    }

    public function message()
    {
        return [
            'notification_id.required' => '目标ID'
        ];
    }
}
