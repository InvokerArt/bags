<?php

namespace App\Api\V1\Transformers;

class DemandShowTransformer extends BaseTransformer
{
    protected $defaultIncludes = ['user'];
    
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'title' => $model->title,
            'quantity' => $model->quantity,
            'unit' => $model->unit,
            'content' => $model->content,
            'images' => $model->images ? img_fullurl($model->images) : [],
            'is_excellent' => $model->is_excellent == 'yes' ? 1 : 0,
        ];
    }

    public function includeUser($model)
    {
        return $this->item($model->user, new UserTransformer());
    }
}
