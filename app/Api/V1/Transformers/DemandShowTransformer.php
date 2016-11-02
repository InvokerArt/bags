<?php

namespace App\Api\V1\Transformers;

class DemandShowTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'title' => $model->title,
            'quantity' => $model->quantity,
            'unit' => $model->unit,
            'content' => $model->content,
            'images' => $model->images
        ];
    }
}
