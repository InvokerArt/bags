<?php

namespace App\Api\V1\Transformers;

use Storage;

class ExhibitionTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'title' => $model->title,
            'address' => $model->address,
            'telephone' => $model->telephone,
            'image' => $model->image,
            'is_excellent' => $model->is_excellent == 'yes' ? 1 : 0,
            'is_top' => $model->is_excellent == 'yes' ? 1 : 0
        ];
    }
}
