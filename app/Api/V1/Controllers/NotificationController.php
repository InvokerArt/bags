<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\NotificationTransformer;
use Auth;

class NotificationController extends BaseController
{
    public function index()
    {
        $unReadNotifications = Auth::user()->unreadNotifications;
        return $this->response->collection($unReadNotifications, new NotificationTransformer());
    }

    public function makeAsRead($id)
    {
        $unreadNotification = Auth::user()->notifications()->where('id', $id)->delete();
        return $this->response->noContent();
    }
}
