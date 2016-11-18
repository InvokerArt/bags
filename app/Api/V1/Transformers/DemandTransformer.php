<?php

namespace App\Api\V1\Transformers;

class DemandTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'title' => $model->title,
            'quantity' => $model->quantity,
            'unit' => $model->unit,
            'images' => $model->images ? img_fullurl($model->images) : [],
            'is_excellent' => $model->is_excellent == 'yes' ? 1 : 0,
        ];
    }
}
