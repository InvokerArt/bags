<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\NotificationTransformer;
use App\Models\Notification;
use App\Models\NotificationUser;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends BaseController
{
    /**
     * @apiDefine Notify 通知
     */
    
    /**
     * @api {get} /notifications 通知
     * @apiDescription 通知
     * @apiGroup Notify
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
    {
        "data": [
            {
                "id": 104,
                "title": "系统通知",
                "notification_id": 26,
                "notification_type": "App\\Models\\Join",
                "message": "user • 申请认证，请您及时处理。",
                "sender": 2,
                "read_at": "",
                "created_at": "2016-11-14 04:02:52"
            },
            {
                "id": 96,
                "title": "赞了你的回复",
                "notification_id": 1,
                "notification_type": "App\\Models\\Reply",
                "message": "user • 赞了你的回复",
                "sender": 2,
                "read_at": "",
                "created_at": "2016-11-14 03:26:29"
            },
            {
                "id": 95,
                "title": "赞了你的主题",
                "notification_id": 4,
                "notification_type": "App\\Models\\Topic",
                "message": "user • 赞了你的主题 • 我再发布了一个话题",
                "sender": 2,
                "read_at": "",
                "created_at": "2016-11-14 03:18:19"
            },
            {
                "id": 57,
                "title": "系统消息",
                "notification_id": 5,
                "notification_type": "App\\Models\\News",
                "message": "啊大大",
                "sender": "",
                "read_at": "",
                "created_at": "2016-11-11 02:15:00"
            },
            {
                "id": 56,
                "title": "系统消息",
                "notification_id": 5,
                "notification_type": "App\\Models\\News",
                "message": "啊大大",
                "sender": "",
                "read_at": "",
                "created_at": "2016-11-11 02:15:00"
            },
            {
                "id": 55,
                "title": "系统消息",
                "notification_id": 5,
                "notification_type": "App\\Models\\News",
                "message": "啊大大",
                "sender": "",
                "read_at": "",
                "created_at": "2016-11-11 02:15:00"
            },
            {
                "id": 54,
                "title": "系统消息",
                "notification_id": 5,
                "notification_type": "App\\Models\\News",
                "message": "我现在要给所有用户发一条内部消息",
                "sender": "",
                "read_at": "",
                "created_at": "2016-11-11 02:15:00"
            },
            {
                "id": 53,
                "title": "系统消息",
                "notification_id": 4,
                "notification_type": "App\\Models\\News",
                "message": "我现在要给所有用户发一条内部消息",
                "sender": "",
                "read_at": "",
                "created_at": "2016-11-11 02:15:00"
            },
            {
                "id": 6,
                "title": "系统消息",
                "notification_id": 3,
                "notification_type": "App\\Models\\Topic",
                "message": "我推送了什么消息吗",
                "sender": "",
                "read_at": "",
                "created_at": "2016-11-10 11:02:43"
            },
            {
                "id": 5,
                "title": "系统消息",
                "notification_id": 2,
                "notification_type": "App\\Models\\Topic",
                "message": "我推送论坛消息",
                "sender": "",
                "read_at": "",
                "created_at": "2016-11-10 11:02:43"
            },
            {
                "id": 4,
                "title": "系统消息",
                "notification_id": 1,
                "notification_type": "App\\Models\\Topic",
                "message": "我是推送消息",
                "sender": "",
                "read_at": "2016-11-10 11:04:48",
                "created_at": "2016-11-10 11:02:43"
            }
        ]
    }
     * @apiSampleRequest /api/notifications
     */
    public function index()
    {
        //生成消息开始
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
        }//结束
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
     * @api {post} /notifications/ 消息回调
     * @apiDescription 消息回调
     * @apiGroup Notify
     * @apiPermission 认证
     * @apiVersion 1.0.0
     * @apiHeader Authorization Bearer {access_token}
     * @apiParam {Number} notification_id
     * @apiParam {String} notification_type
     * @apiParam {String} message
     * @apiParam {String} created_at
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 201 Created
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();
        //防止非系统消息一条消息变两条问题
        if ($request->message == 'system') {
            $message = Notification::select('id')->where('notification_id', $request->notification_id)->where('notification_type', $request->notification_type)->where('data', $request->message)->where('created_at', $request->created_at)->first();
            $notification = new NotificationUser();
            $notification->user_id = $user_id;
            $notification->notification_id = $message->id;
            $notification->read_at = Carbon::now();
            $notification->created_at = $request->created_at;
            $notification->updated_at = $request->created_at;
            $notification->save();
        } else {
            $notificationUser = NotificationUser::where('notification_id', $request->notification_id);
            $notificationUser->read_at = Carbon::now();
            $notificationUser->update();
        }
    }
}
