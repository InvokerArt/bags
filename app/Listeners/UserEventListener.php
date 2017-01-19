<?php

namespace App\Listeners;

use App\Repositories\Backend\Notifications\NotificationRepository;
use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Log;
use Storage;

class UserEventListener implements ShouldQueue
{
    protected $notification;

    public static $token = null;
    public static $tokenPath = 'easemob.token';

    public function __construct(NotificationRepository $notification)
    {
        $this->url = 'https://a1.easemob.com/'.env('EASEMOB_ORG_NAME').'/'.env('EASEMOB_APP_NAME').'/';
        $this->notification = $notification;
    }

    //获取token，当操作有权限的行为时，需要token
    public function getToken()
    {
        if (self::$token==null) {
            $file = self::$tokenPath;
            if (Storage::disk()->exists($file) && time() - ( $createTime = Storage::disk()->lastModified($file) ) <= 7200) {
                $token = Storage::disk()->get($file);
                self::$token = json_encode(array(
                    'token'=>$token,
                    'createtime'=>$createTime
                ));
                return $token;
            }
        } else {
            $token = json_decode(self::$token, true);
            if ($token['createtime'] + 7200 > time()) {
                return $token['token'];
            }
        }
        //返回远程token
        return $this->getRemoteToken();
    }

    //从接口中获得token
    public function getRemoteToken()
    {
        $file = self::$tokenPath;
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', $this->url.'token', [
                'json' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => env('EASEMOB_CLIENT_ID'),
                    'client_secret' => env('EASEMOB_CLIENT_SECRET'),
                ],
            ]);
            $reponse = json_decode((string) $response->getBody(), true);
            if (Storage::disk()->exists($file)) {
                Storage::disk()->delete($file);
            }
            Storage::disk()->put($file, $reponse['access_token'] );
            self::$token = json_encode(array(
                'token' => $reponse['access_token'],
                'createtime'=> time()
            ));
            return $reponse['access_token'];
        } catch (RequestException $e) {
            Log::info($e->getMessage());
        }
    }

    public function create($event)
    {
        //创建环信即时通讯账号
        $token = $this->getToken();
        try {
            $client = new \GuzzleHttp\Client();
            $registerResponse = $client->request('POST', $this->url.'users', [
                'headers' => [
                    'Authorization' => 'Bearer '.$token
                ],
                'json' => [
                    'username' => $event->user->mobile,
                    'password' => $event->user->newpassword,
                ],
            ]);
            $registerResult = json_decode((string) $registerResponse->getBody(), true);
        } catch (RequestException $e) {
            Log::info($e->getMessage());
        }
    }

    public function update($event)
    {
        //更新环信即时通讯密码
        $token = $this->getToken();
        try {
            $client = new \GuzzleHttp\Client();
            $registerResponse = $client->request('PUT', $this->url.'users/'.$event->user->mobile.'/password', [
                'headers' => [
                    'Authorization' => 'Bearer '.$token
                ],
                'json' => [
                    'newpassword' => $event->user->newpassword,
                ],
            ]);
            $registerResult = json_decode((string) $registerResponse->getBody(), true);
        } catch (RequestException $e) {
            Log::info($e->getMessage());
        }
    }

    public function delete($event)
    {
        //删除环信即时通讯账号
        $token = $this->getToken();
        try {
            $client = new \GuzzleHttp\Client();
            $registerResponse = $client->request('DELETE', $this->url.'users/'.$event->user->mobile, [
                'headers' => [
                    'Authorization' => 'Bearer '.$token
                ],
            ]);
            $registerResult = json_decode((string) $registerResponse->getBody(), true);
        } catch (RequestException $e) {
            Log::info($e->getMessage());
        }
        //删除通知消息
        $notifications = $this->notification->getNotificationsBySender($event->user->id);
        foreach ($notifications as $notification) {
            $this->notification->destroy($notification);
        }
    }

    public function subscribe($events)
    {
        $events->listen(
           \App\Events\UserCreateEvent::class,
            'App\Listeners\UserEventListener@create'
        );

        $events->listen(
           \App\Events\UserUpdateEvent::class,
            'App\Listeners\UserEventListener@update'
        );

        $events->listen(
           \App\Events\UserPermanentlyDeleted::class,
            'App\Listeners\UserEventListener@delete'
        );
    }
}
