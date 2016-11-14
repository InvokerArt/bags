<?php

namespace App\Api\V1\Transformers;

use Storage;

class NewsTransformer extends BaseTransformer
{
    protected $defaultIncludes = ['categories'];

    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'title' => $model->title,
            'subtitle' => $model->subtitle,
            'image' => $model->image,
            'updated_at' => $model->updated_at->toDateTimeString(),
            'is_excellent' => $model->is_excellent == 'yes' ? 1 : 0,
            'is_top' => $model->is_excellent == 'yes' ? 1 : 0
        ];
    }

    public function includeCategories($model)
    {
        return $this->collection($model->categories, new CategoryTransformer());
    }
}
