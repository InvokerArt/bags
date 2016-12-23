<?php

namespace App\Api\V1\Transformers;

use App\Models\Area;
use Storage;

class CompanyUpdateTransformer extends BaseTransformer
{
    protected $defaultIncludes = ['user'];

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
            'content' => $model->content,
            'notes' => $model->notes,
            'role' => $model->role,
            'photos' => $model->photos ? img_fullurl($model->photos) : [],
            'licenses' => $model->licenses ? img_fullurl($model->licenses) : [],
            'created_at' => $model->created_at->toDateTimeString()
        ];
    }

    public function includeUser($model)
    {
        return $this->item($model->user, new UserTransformer());
    }
}
