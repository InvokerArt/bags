<?php

namespace App\Api\V1\Transformers;

use Storage;

class NewsTransformer extends BaseTransformer
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
        ];
    }
}
