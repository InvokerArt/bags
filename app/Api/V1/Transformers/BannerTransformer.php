<?php

namespace App\Api\V1\Transformers;

use Storage;

class BannerTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'title' => $model->title,
            'image_url' => asset(Storage::url($model->image_url)),
            'order' => $model->order,
            'link' => $model->link,
            'published_from' => $model->published_from->toDateTimeString(),
            'published_to' => $model->published_to->toDateTimeString(),
        ];
    }
}
