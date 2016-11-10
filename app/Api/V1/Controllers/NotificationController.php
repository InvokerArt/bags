<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\NotificationTransformer;
use App\Models\Notifications\Notification;
use App\Models\Notifications\NotificationUser;
use Auth;
use Carbon\Carbon;

class NotificationController extends BaseController
{
    /**
     * @apiDefine Notify 通知
     */
    
    /**
     * @api {get} /notifications 未读通知
     * @apiDescription 未读通知
     * @apiGroup Notify
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": [
            {
                "notify_id": "8fa4f38d-fb89-4750-8635-ad5315f79390",
                "content": {
                    "id": 1,
                    "title": "互动消息",
                    "message": "有人赞了您的帖子，去查看。",
                    "type": "App\\Models\\Topics\\Vote",
                    "date": "2016-11-09 01:36:54",
                    "user_id": 2
                },
                "read_at": ""
            },
            {
                "notify_id": "a6d30191-ed5f-47fd-8ba8-3d6eddebfac7",
                "content": {
                    "id": 1,
                    "title": "互动消息",
                    "message": "有人赞了您的帖子，去查看。",
                    "type": "App\\Models\\Topics\\Vote",
                    "date": "2016-11-08 12:31:01",
                    "user_id": 2
                },
                "read_at": "2016-11-09 01:33:28"
            }
        ]
    }
     * @apiSampleRequest /api/notifications
     */
    public function index()
    {
        $notifications = NotificationUser::with('notification')->where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return $this->response->collection($notifications, new NotificationTransformer());
    }

    /**
     * @api {post} /notifications/:id 标记已读
     * @apiDescription 标记已读
     * @apiGroup Notify
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 204 No Content
     */
    public function makeAsRead($id)
    {
        $unreadNotification = NotificationUser::where('id', $id)->where('user_id', Auth::id())->first();
        $unreadNotification->read_at = new Carbon;
        $unreadNotification->save();
        return $this->response->noContent();
    }

    /**
     * @api {post} /notifications/ 拉取未读消息
     * @apiDescription 拉取未读消息
     * @apiGroup Notify
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     */
    public function store()
    {
        $user = Auth::user();
        $lastNotification = NotificationUser::select('created_at')->where('user_id', $user->id)->orderBy('created_at', 'desc')->first();
        $lastReadAt = ($lastNotification) ? $lastNotification->created_at : '';
        $unreadNotifications = Notification::where('created_at', '>=', $lastReadAt)->get();
        if ($unreadNotifications) {
            foreach ($unreadNotifications as $key => $unreadNotification) {
                $notificationuser = new NotificationUser();
                $notificationuser->user_id = $user->id;
                $notificationuser->notification_id = $unreadNotification->id;
                $notificationuser->save();
            }
        }
        return $this->response->created();
    }
}
