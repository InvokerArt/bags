<?php

namespace App\Listeners;

use Dingo\Api\Event\ResponseWasMorphed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddPaginationLinksToResponse
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ResponseWasMorphed  $event
     * @return void
     */
    public function handle(ResponseWasMorphed $event)
    {
        //
    }
}
