<?php

namespace App\Repositories\Backend\Notifications;

use App\Events\NotificationSystemEvent;
use App\Events\NotificationPersonalEvent;
use App\Models\Notification;
use App\Models\NotificationUser;
use Auth;
use DB;

class NotificationRepository implements NotificationInterface
{

    public function getForDataTable()
    {
        return Notification::where('type', 'system')->get();
    }
    
    //系统通知
    public function create($input)
    {
        $notification = new Notification;
        $notification->type = 'system';
        $notification->notification_id = $input['notification_id'];
        $notification->notification_type = $input['notification_type'];
        $notification->data = $input['data'];

        DB::transaction(function () use ($notification) {
            if ($notification->save()) {
                return $notification;
            }

            throw new GeneralException("添加失败");
        });
        event(new NotificationSystemEvent($notification));
    }
    
    //私人通知-----话题点赞或回复点赞或话题回复
    public function createPersonal($input)
    {
        $notification = new Notification;
        $notification->type = 'user';
        $notification->notification_id = $input->id;
        $notification->notification_type = $input->type;
        $notification->action = $input->action;
        $notification->sender = Auth::id();
        $notificationUser = new NotificationUser(['user_id' => $input->user_id]);

        DB::transaction(function () use ($notification, $notificationUser, $input) {
            if ($notification->save()) {
                $notification->notificationUser()->save($notificationUser);
                return $notification;
            }

            throw new GeneralException("添加失败");
        });
        event(new NotificationPersonalEvent($notification));
    }

    public function destroy($id)
    {
        $notification = Notification::find($id);
        if ($notification->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }
}
