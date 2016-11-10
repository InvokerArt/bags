<?php

namespace App\Listeners;

use App\Notifications\VoteNotification;
use Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Hanlder\NotificationPush;

class TopicEventListener
{
    public function onCreate($event)
    {
        $notification = $event->notification;
        $data['type'] = $notification->type;
        $data['notification_id'] = $notification->notification_id;
        $data['notification_type'] = $notification->notification_type;
        $data['content'] = $notification->content;
        $data['created_at'] = $notification->created_at->toDateTimeString();

        NotificationPush::send($data);
    }

    public function onCreateNotificationUser($event)
    {
        $notification = $event->notification;
        $notification_user = $notification->notificationUser()->select(['id', 'user_id'])->first();
        $data['id'] = $notification_user->id;
        $data['type'] = $notification->type;
        $data['notification_id'] = $notification->notification_id;
        $data['notification_type'] = $notification->notification_type;
        $data['action'] = $notification->action;
        $data['from'] = $notification->sender;
        $data['to'] = $notification_user->user_id;
        $data['created_at'] = $notification->created_at->toDateTimeString();

        NotificationPush::send($data);
    }

    public function subscribe($events)
    {
        $events->listen(
           \App\Events\TopicSystemEvent::class,
            'App\Listeners\TopicEventListener@onCreate'
        );

        $events->listen(
           \App\Events\TopicUserEvent::class,
            'App\Listeners\TopicEventListener@onCreateNotificationUser'
        );
    }
}
