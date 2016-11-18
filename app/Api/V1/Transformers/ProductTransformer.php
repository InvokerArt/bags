<?php

namespace App\Api\V1\Transformers;

use App\Models\Area;
use Storage;

class ProductTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'title' => $model->title,
            'price' => $model->price,
            'unit' => $model->unit,
            'content' => $model->content,
            'images' => img_fullurl($model->images)
        ];
    }
}
