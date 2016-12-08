<?php

namespace App\Hanlder;

use Carbon\Carbon;
use Jpush;
use Auth;
use Log;

class NotificationPush
{
    public static function send($data)
    {
        if ($data['type'] == 'system') {
            $title = '系统消息';
        } else {
            $title = $data['title'];
            $to = $data['to'];
        }
        unset($data['type'], $data['to'], $data['title']);
        $push = Jpush::push()
        ->setPlatform('all')
        ->iosNotification($title, array(
            'sound' => 'sound.caf',
            'content-available' => true,
            'mutable-content' => true,
            'extras' => [
                'message' => json_encode($data)
            ],
        ))
        ->message(json_encode($data));

        if ($title == '系统消息') {
            $push->addAllAudience();
        } else {
            $push->addAlias(json_encode($to));
        }

        try {
            $response = $push->send();
        } catch (\JPush\Exceptions\APIConnectionException $e) {
            //Log::error($e);
        } catch (\JPush\Exceptions\APIRequestException $e) {
            //Log::error($e);
        }
    }
}
