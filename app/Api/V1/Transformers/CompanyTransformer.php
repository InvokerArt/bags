<?php

namespace App\Api\V1\Transformers;

use App\Models\Area;
use Storage;

class CompanyTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        $area = Area::select('name', 'parent_id')->where('code', $model->address)->first();
        $city = Area::select('name', 'parent_id')->where('code', $area->parent_id)->first();
        $province = Area::select('name')->where('code', $city->parent_id)->first();
        $location = $province->name.$city->name.$area->name;
        return [
            'id' => $model->id,
            'name' => $model->name,
            'province' => $province->name,
            'city' => $city->name,
            'area' => $area->name,
            'addressDetail' => $model->addressDetail,
            'telephone' => $model->telephone,
            'photos' => $model->photos,
            'is_validate' => (bool)count($model->certifications),
            'is_excellent' => $model->is_excellent == 'yes' ? 1 : 0,
        ];
    }
}
