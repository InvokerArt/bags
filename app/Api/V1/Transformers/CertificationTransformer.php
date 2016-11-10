<?php

namespace App\Api\V1\Transformers;

use App\Models\Area;
use Storage;

class CertificationTransformer extends BaseTransformer
{
    protected $defaultIncludes = ['company'];

    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'status' => $model->status,
        ];
    }

    public function includeCompany($model)
    {
        return $this->item($model->company, new CompanyTransformer);
    }
}
