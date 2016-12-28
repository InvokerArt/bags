<?php

namespace App\Api\V1\Transformers;

use App\Hanlder\NotificationPresenter;
use App\Models\User;
use App\Notification;

class NotificationTransformer extends BaseTransformer
{
    use NotificationPresenter;

    public function transformData($model)
    {
        $this->action  = $model->notification->action;
        $relationship = $model->notification()->with('notification')->first();
        if ($model->notification->type === 'system') {
            $subject = '系统消息';
        } else {
            $subject = $this->subject();
            dump($relationship->notification);
            $title = isset($relationship->notification->title) ? ' • '.$relationship->notification->title : '';
            $message = User::find($model->notification->sender)->username. ' • ' . $this->lableUp().$title;
        }
        return [
            'id' => $model->id,
            'title' => $subject,
            'notification_id' => $model->notification->notification_id,
            'notification_type' => $model->notification->notification_type,
            'message' => $model->notification->data ?  $model->notification->data : $message,
            'sender' => $model->notification->sender,
            'read_at' => isset($model->read_at) ? $model->read_at->toDateTimeString() : '',
            'created_at' => $model->created_at->toDateTimeString(),
        ];
    }
}
