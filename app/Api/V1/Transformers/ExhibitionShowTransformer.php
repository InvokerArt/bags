<?php

namespace App\Api\V1\Transformers;

use Storage;

class ExhibitionTransformer extends BaseTransformer
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
            'created_at' => $model->created_at->toDateTimeString(),
        ];
    }
}
