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
            'product_id' => $model->product_id,
            'title' => $model->title,
            'price' => $model->price,
            'unit' => $model->unit,
            'content' => $model->content,
            'images' => $model->images ? img_fullurl($model->images) : [],
            'is_favorite' => isset($model->is_favorite) && $model->is_favorite ? 1 : 0,
        ];
    }
}
