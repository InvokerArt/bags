<?php

namespace App\Repositories\Backend\Notifications;

use App\Events\NotificationSystemEvent;
use App\Events\NotificationPersonalEvent;
use App\Models\Notification;
use App\Models\NotificationUser;
use Auth;
use DB;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class NotificationRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = Notification::class;

    protected $notificationUsers;

    public function __construct(NotificationUser $notificationUsers)
    {
        $this->notificationUsers = $notificationUsers;
    }

    public function getForDataTable()
    {
        return $this->query()->where('type', 'system')->get();
    }
    
    //系统通知
    public function create($input)
    {
        $notification = self::MODEL;
        $notification = new $notification;
        $notification->type = 'system';
        $notification->notification_id = $input['notification_id'];
        $notification->notification_type = $input['notification_type'];
        $notification->data = $input['data'];

        DB::transaction(function () use ($notification) {
            if (parent::save($notification)) {
                return $notification;
            }

            throw new GeneralException("添加失败");
        });
        event(new NotificationSystemEvent($notification));
    }
    
    //私人通知-----话题点赞或回复点赞或话题回复
    public function createPersonal($input)
    {
        $notification = self::MODEL;
        $notification = new $notification;
        $notification->type = 'user';
        $notification->sender = Auth::id();
        $notificationUser = new NotificationUser(['user_id' => $input->user_id]);

        DB::transaction(function () use ($notification, $notificationUser, $input) {
            if (parent::save($notification)) {
                $notification->notificationUser()->save($notificationUser);
                return $notification;
            }

            throw new GeneralException("添加失败");
        });
        event(new NotificationPersonalEvent($notification));
    }

    public function destroy(Model $notification)
    {
        if (parent::delete($notification)) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function index()
    {
        return $this->notificationusers->with('notification')->where('user_id', Auth::id())->orderBy('id', 'desc')->get();
    }

    public function createUsersNotifications()
    {
        //生成消息开始
        $user = Auth::user();
        $lastNotification = $this->notificationusers->select('created_at')->where('user_id', $user->id)->orderBy('created_at', 'desc')->first();
        $lastReadAt = ($lastNotification) ? $lastNotification->created_at : '';
        $unreadNotifications = $this->query()->where('created_at', '>', $lastReadAt)->where('type', 'system')->get();
        if ($unreadNotifications) {
            foreach ($unreadNotifications as $key => $unreadNotification) {
                $notificationuser = new NotificationUser();
                $notificationuser->user_id = $user->id;
                $notificationuser->notification_id = $unreadNotification->id;
                $notificationuser->save();
            }
        }
        //结束
    }

    public function makeAsRead($id)
    {
        $unreadNotification = $this->notificationusers->where('id', $id)->where('user_id', Auth::id())->first();
        $unreadNotification->read_at = new Carbon;
        parent::save($unreadNotification);
    }

    public function createOrUpdate($input)
    {
        $user_id = Auth::id();
        $message = $this->query()->select('id')->where('notification_id', $input->notification_id)->where('notification_type', $input->notification_type)->where('created_at', $input->created_at)->first();
        //防止非系统消息一条消息变两条问题
        if ($input->message == 'system') {
            $notification = new NotificationUser();
            $notification->user_id = $user_id;
            $notification->notification_id = $message->id;
            $notification->read_at = Carbon::now();
            $notification->created_at = $input->created_at;
            $notification->updated_at = $input->created_at;
            $notification->save();
        } else {
            $notificationUser = $this->notificationusers->where('notification_id', $message->id);
            $notificationUser->update(['read_at' => Carbon::now()]);
        }
    }
}
