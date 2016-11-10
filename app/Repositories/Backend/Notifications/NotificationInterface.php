<?php

namespace App\Repositories\Backend\Notifications;

use App\Models\Notifications\Notification;

interface NotificationInterface
{
    public function getForDataTable();
    
    public function create($input);
    
    public function createNotificationUser($input);

    public function destroy($id);
}
