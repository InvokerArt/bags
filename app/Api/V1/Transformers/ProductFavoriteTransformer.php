<?php

namespace App\Api\V1\Transformers;

use App\Models\Area;
use Storage;

class ProductFavoriteTransformer extends BaseTransformer
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
        ];
    }
}
