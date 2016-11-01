<?php

namespace App\Api\V1\Transformers;

use Storage;

class CategoryTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name
        ];
    }
}
