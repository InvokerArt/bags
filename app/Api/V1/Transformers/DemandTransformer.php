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
            'images' => $model->images
        ];
    }
}
