<?php

namespace App\Api\V1\Transformers;

use App\Models\Area;
use Storage;

class CompanyShowTransformer extends BaseTransformer
{
    protected $defaultIncludes = ['categories', 'products', 'jobs', 'user'];

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
            'role' => $model->role,
            'photos' => $model->photos ? img_fullurl($model->photos) : [],
            'licenses' => $model->licenses ? img_fullurl($model->licenses) : [],
            'created_at' => $model->created_at->toDateTimeString(),
            'is_favorite' => isset($model->is_favorite) && $model->is_favorite ? 1 : 0,
        ];
    }

    public function includeCategories($model)
    {
        return $this->collection($model->categories, new CategoryTransformer);
    }

    public function includeProducts($model)
    {
        return $this->collection($model->products, new ProductTransformer);
    }

    public function includeJobs($model)
    {
        return $this->collection($model->jobs, new JobTransformer);
    }

    public function includeUser($model)
    {
        return $this->item($model->user, new UserTransformer());
    }
}
