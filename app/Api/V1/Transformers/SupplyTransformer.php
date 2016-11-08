<?php

namespace App\Api\V1\Transformers;

class SupplyTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'title' => $model->title,
            'images' => $model->images,
            'content' => $model->content,
            'is_excellent' => $model->is_excellent == 'yes' ? 1 : 0,
        ];
    }
}
