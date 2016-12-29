<?php

namespace App\Api\V1\Transformers;

class SupplyFavoriteTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'supply_id' => $model->supply_id,
            'title' => $model->title,
            'price' => $model->price,
            'unit' => $model->unit,
            'images' => $model->images ? img_fullurl($model->images) : [],
            'content' => $model->content,
            'is_excellent' => $model->is_excellent == 'yes' ? 1 : 0,
        ];
    }
}
