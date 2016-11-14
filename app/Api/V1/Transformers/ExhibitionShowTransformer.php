<?php

namespace App\Api\V1\Transformers;

use Storage;

class ExhibitionShowTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'title' => $model->title,
            'subtitle' => $model->subtitle,
            'address' => $model->address,
            'telephone' => $model->telephone,
            'content' => $model->content,
            'image' => $model->image,
            'published_at' => $model->published_at->toDateTimeString(),
            'created_at' => $model->created_at->toDateTimeString(),,
            'is_excellent' => $model->is_excellent == 'yes' ? 1 : 0,
            'is_top' => $model->is_excellent == 'yes' ? 1 : 0
        ];
    }
}
