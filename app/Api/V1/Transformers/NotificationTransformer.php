<?php

namespace App\Api\V1\Transformers;

use App\Notification;

class NotificationTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'type' => $model->notification->type,
            'notification_id' => $model->notification->notification_id,
            'notification_type' => $model->notification->notification_type,
            'content' => $model->notification->data,
            'action' => $model->notification->action,
            'sender' => $model->notification->sender,
            'read_at' => isset($model->read_at) ? $model->read_at->toDateTimeString() : '',
        ];
    }
}
