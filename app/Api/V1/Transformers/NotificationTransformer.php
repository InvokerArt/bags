<?php

namespace App\Api\V1\Transformers;

use App\Notification;

class NotificationTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'notify_id' => $model->id,
            'content' => $model->data
        ];
    }
}
