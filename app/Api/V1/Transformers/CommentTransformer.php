<?php

namespace App\Api\V1\Transformers;

use App\Models\User;
use Storage;

class CommentTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'user_id' => $model->user_id,
            'username' => User::find($model->user_id)->username,
            'parent_id' => $model->parent_id,
            'content' => $model->content,
            'created_at' => $model->created_at->toDateTimeString(),
        ];
    }
}
