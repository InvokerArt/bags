<?php

namespace App\Api\V1\Transformers;

use App\Models\Area;
use Storage;

class ProductShowTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        $area = Area::select('name', 'parent_id')->where('code', $model->address)->first();
        $city = Area::select('name', 'parent_id')->where('code', $area->parent_id)->first();
        $province = Area::select('name')->where('code', $city->parent_id)->first();
        $location = $province->name.$city->name.$area->name;
        return [
            'id' => $model->id,
            'title' => $model->title,
            'address' => $location,
            'telephone' => $model->telephone,
            'price' => $model->price,
            'unit' => $model->unit,
            'content' => $model->content,
            'images' => $model->images
        ];
    }
}
