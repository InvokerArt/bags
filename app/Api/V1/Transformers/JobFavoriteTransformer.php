<?php

namespace App\Api\V1\Transformers;

use Storage;

class JobFavoriteTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'company_id' => $model->company_id,
            'job' => $model->job,
            'total' => $model->total,
            'education' => $model->education,
            'experience' => $model->experience,
            'minsalary' => $model->minsalary,
            'content' => $model->content,
            'is_favorite' => isset($model->is_favorite) && $model->is_favorite ? 1 : 0,
        ];
    }
}
