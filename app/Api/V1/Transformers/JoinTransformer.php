<?php

namespace App\Api\V1\Transformers;

use App\Models\Area;
use Storage;

class JoinTransformer extends BaseTransformer
{
    protected $defaultIncludes = ['company'];

    public function transformData($model)
    {
        if ($model->relationLoaded('userCompany')) {
            $model->company = $model->userCompany;
        }
        return [
            'id' => $model->id,
            'status' => $model->status,
            'identity_card' => img_fullurl($model->identity_card),
            'licenses' => img_fullurl($model->licenses)
        ];
    }

    public function includeCompany($model)
    {
        return $this->item($model->company, new CompanyTransformer);
    }
}
