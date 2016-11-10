<?php

namespace App\Repositories\Backend\Notifications;

use App\Events\TopicSystemEvent;
use App\Events\TopicUserEvent;
use App\Models\Notifications\Notification;
use App\Models\Notifications\NotificationUser;
use Auth;
use DB;

class NotificationRepository implements NotificationInterface
{

    public function getForDataTable()
    {
        return Notification::where('type', 'system')->get();
    }
    
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
        event(new TopicSystemEvent($notification));
    }
    
    public function createNotificationUser($input)
    {
        if ($input->votes()->ByWhom(Auth::id())->WithType('vote')->count()) {
            // 已经点过赞
            $input->votes()->ByWhom(Auth::id())->WithType('vote')->delete();
            $input->decrement('vote_count', 1);
        } else {
            // 第一次点击
            $input->votes()->create(['user_id' => Auth::id(), 'is' => 'vote']);
            $input->increment('vote_count', 1);
            $type = get_class($input);
            $action = request()->segment(4);
            //判断是否发送过通知
            $hasNotification = Notification::where('notification_id', $input->id)->where('notification_id', $type)->where('type', '!=', 'user')->first();
            if ($hasNotification) {
                return;
            }
            $notification = new Notification;
            $notification->type = 'user';
            $notification->notification_id = $input->id;
            $notification->notification_type = $type;
            $notification->action = $action;
            $notification->sender = Auth::id();
            $notificationUser = new NotificationUser(['user_id' => $input->user_id]);

            DB::transaction(function () use ($notification, $notificationUser, $input) {
                if ($notification->save()) {
                    $notification->notificationUser()->save($notificationUser);
                    return $notification;
                }

                throw new GeneralException("添加失败");
            });
            event(new TopicUserEvent($notification));
        }
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
