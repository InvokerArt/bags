<?php

namespace App\Api\V1\Transformers;

use Storage;

class JobTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'content' => $model->content,
        ];
    }
}
