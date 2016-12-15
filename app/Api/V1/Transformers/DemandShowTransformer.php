<?php

namespace App\Api\V1\Transformers;

use App\Models\Area;

class DemandShowTransformer extends BaseTransformer
{
    protected $defaultIncludes = ['user'];
    
    public function transformData($model)
    {
        $area = Area::select('name', 'parent_id')->where('code', $model->address)->first();
        $city = Area::select('name', 'parent_id')->where('code', $area->parent_id)->first();
        $province = Area::select('name')->where('code', $city->parent_id)->first();
        return [
            'id' => $model->id,
            'title' => $model->title,
            'quantity' => $model->quantity,
            'unit' => $model->unit,
            'content' => $model->content,
            'images' => $model->images ? img_fullurl($model->images) : [],
            'is_excellent' => $model->is_excellent == 'yes' ? 1 : 0,
            'province' => $province->name,
            'city' => $city->name,
            'area' => $area->name,
            'addressDetail' => $model->addressDetail
        ];
    }

    public function includeUser($model)
    {
        return $this->item($model->user, new UserTransformer());
    }
}
