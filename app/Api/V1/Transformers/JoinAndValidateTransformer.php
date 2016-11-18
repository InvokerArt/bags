<?php

namespace App\Api\V1\Transformers;

use App\Models\Area;
use Storage;

class JoinAndValidateTransformer extends BaseTransformer
{
    protected $defaultIncludes = ['user', 'company'];

    public function transformData($model)
    {
        $area = Area::select('name', 'parent_id')->where('code', $model->address)->first();
        $city = Area::select('name', 'parent_id')->where('code', $area->parent_id)->first();
        $province = Area::select('name')->where('code', $city->parent_id)->first();
        $location = $province->name.$city->name.$area->name;
        return [
            'id' => $model->id,
            'name' => $model->name,
            'address' => $location,
            'telephone' => $model->telephone,
            'notes' => $model->notes,
            'image' => img_fullurl($model->photos)
        ];
    }

    public function includeUser($model)
    {
        return $this->item($model->user, new UserTransformer);
    }

    public function includeCompany($model)
    {
        return $this->item($model->company, new CompanyTransformer);
    }
}
