<?php

namespace App\Listeners;

use App\Events\NotificationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationEventListener
{
    public function onCreate($event)
    {
        dd($event);
    }

    public function subscribe($events)
    {
        $events->listen(
           \App\Events\NotificationEvent::class,
            'App\Listeners\NotificationEventListener@onCreate'
        );
    }
}
