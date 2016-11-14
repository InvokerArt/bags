<?php

namespace App\Api\V1\Transformers;

use Storage;

class NewsShowTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'title' => $model->title,
            'subtitle' => $model->subtitle,
            'content' => $model->content,
            'image' => $model->image,
            'created_at' => $model->created_at->toDateTimeString(),
            'is_excellent' => $model->is_excellent == 'yes' ? 1 : 0,
            'is_top' => $model->is_excellent == 'yes' ? 1 : 0
        ];
    }
}
