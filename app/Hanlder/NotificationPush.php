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
            'extras' => json_encode($data),
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
            throw new \Exception($e->getMessage());
        } catch (\JPush\Exceptions\APIRequestException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
