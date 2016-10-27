<?php

namespace App\Http\Requests\Backend\Banners;

use Illuminate\Foundation\Http\FormRequest;

class ImageUpdateRequest extends FormRequest
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
            'banner_id' => 'required',
            'title' => 'required',
            'new_image' => 'image',
            'link' => 'active_url',
            'published_from' => 'required',
            'published_to' => 'required'
        ];
    }
}
