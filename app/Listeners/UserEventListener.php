<?php

namespace App\Listeners;

use App\Events\AuthEvent;
use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Storage;
use Log;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class UserEventListener implements ShouldQueue
{
    public static $token = null;
    public static $tokenPath = 'easemob.token';

    public function __construct()
    {
        $this->url = 'https://a1.easemob.com/'.env('EASEMOB_ORG_NAME').'/'.env('EASEMOB_APP_NAME').'/';
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
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function create($event)
    {
        $token = $this->getToken();
        try {
            $client = new \GuzzleHttp\Client();
            $registerResponse = $client->request('POST', $this->url.'users', [
                'headers' => [
                    'Authorization' => 'Bearer '.$token
                ],
                'json' => [
                    'username' => $event->user->mobile,
                    'password' => $event->user->password,
                ],
            ]);
            $registerResult = json_decode((string) $registerResponse->getBody(), true);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function update($event)
    {
        $token = $this->getToken();
        try {
            $client = new \GuzzleHttp\Client();
            $registerResponse = $client->request('PUT', $this->url.'users/'.$event->user->mobile.'/password', [
                'headers' => [
                    'Authorization' => 'Bearer '.$token
                ],
                'json' => [
                    'newpassword' => $event->user->password,
                ],
            ]);
            $registerResult = json_decode((string) $registerResponse->getBody(), true);
            Log::info($registerResult);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
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
    }
}
