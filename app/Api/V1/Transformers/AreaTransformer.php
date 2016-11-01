<?php

namespace App\Api\V1\Transformers;

use Storage;

class AreaTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'code' => $model->code,
            'parent_id' => $model->parent_id,
            'name' => $model->name,
        ];
    }
}
