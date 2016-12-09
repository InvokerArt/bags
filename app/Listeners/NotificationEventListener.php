<?php

namespace App\Listeners;

use App\Hanlder\NotificationPush;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificationEventListener implements ShouldQueue
{
    public function system($event)
    {
        $notification = $event->notification;
        $data['type'] = $notification->type;
        $data['notification_id'] = $notification->notification_id;
        $data['notification_type'] = $notification->notification_type;
        $data['message'] = $notification->data;
        $data['created_at'] = $notification->created_at->toDateTimeString();

        NotificationPush::send($data);
    }

    public function personal($event)
    {
        $notification = $event->notification;
        $vote = $notification->notification()->first();
        $notification_user = $notification->notificationUser()->select(['id', 'user_id'])->first();
        $fromUser = User::find($notification->sender);
        $action = $notification->action;
        $subject = $notification->subject();
        $voteTitle = $vote->title ? $vote->title. ' • ' : '';
        $message = $fromUser->username. ' • ' . $notification->lableUp().$voteTitle;
        $data['id'] = $notification_user->id;
        $data['type'] = $notification->type;
        $data['notification_id'] = $notification->notification_id;
        $data['notification_type'] = $notification->notification_type;
        $data['to'] = $notification_user->user_id;
        $data['title'] = $subject;
        $data['message'] = $message;
        $data['created_at'] = $notification->created_at->toDateTimeString();

        NotificationPush::send($data);
    }

    public function subscribe($events)
    {
        $events->listen(
           \App\Events\NotificationSystemEvent::class,
            'App\Listeners\NotificationEventListener@system'
        );

        $events->listen(
           \App\Events\NotificationPersonalEvent::class,
            'App\Listeners\NotificationEventListener@personal'
        );
    }
}
