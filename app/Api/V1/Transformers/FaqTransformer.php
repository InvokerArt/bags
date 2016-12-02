<?php

namespace App\Api\V1\Transformers;

class FaqTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'title' => $model->title,
            'content' => $model->content,
        ];
    }
}
