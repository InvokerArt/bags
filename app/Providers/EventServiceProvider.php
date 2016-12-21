<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Dingo\Api\Event\ResponseWasMorphed' => [
            'App\Listeners\AddPaginationLinksToResponse',
        ],
    ];

    /**
     * Class event subscribers
     * @var array
     */
    protected $subscribe = [
        'App\Listeners\NotificationEventListener',
        'App\Listeners\UserEventListener'
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
