<?php

namespace App\Api\V1\Transformers;

class UserTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'username' => $model->username,
            'mobile' => $model->mobile,
            'email' => $model->email,
            'avatar' => $model->avatar,
            'created_at' => $model->created_at->toDateTimeString(),
        ];
    }
}
