<?php

namespace App\Hanlder;

use Carbon\Carbon;
use Jpush;
use Auth;

class NotificationPush
{
    public static function send($data)
    {
        if ($data['type'] == 'system') {
            $message = '系统消息';
        } else {
            $message = '互动消息';
        }
        unset($data['type'], $data['to']);
        $push = Jpush::push()
        ->setPlatform('all')
        ->androidNotification($message, array(
            'build_id' => 2,
            'extras' => json_encode($data),
        ))
        ->iosNotification($message, array(
            'sound' => 'sound.caf',
            'content-available' => true,
            'mutable-content' => true,
            'extras' => json_encode($data),
        ))
        ->message(json_encode($data));

        if ($message == '系统消息') {
            $push->addAllAudience();
        } else {
            $push->addAlias();
        }

        try {
            $response = $push->send();
        } catch (\JPush\Exceptions\APIConnectionException $e) {
            // try something here
        } catch (\JPush\Exceptions\APIRequestException $e) {
            // try something here
        }
    }
}
