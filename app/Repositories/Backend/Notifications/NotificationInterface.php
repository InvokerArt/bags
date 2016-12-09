<?php

namespace App\Repositories\Backend\Notifications;

use App\Models\Notification;

interface NotificationInterface
{
    public function getForDataTable();
    
    public function create($input);
    
    public function createPersonal($input);

    public function destroy($id);
}
