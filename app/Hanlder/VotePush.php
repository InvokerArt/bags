<?php

namespace App\Hanlder;

use Carbon\Carbon;
use Jpush;
use Auth;

class VotePush
{
    public static function send($topic)
    {
        $toUser = $topic->user()->first();
        foreach ($toUser->unreadNotifications as $notification) {
            if ($topic->id == $notification->data['id']) {
                $data['notify_id'] = $notification->id;
                $data['content'] = $notification->data;
            }
        }
        $push = Jpush::push()
        ->setPlatform('all')
        //->addAllAudience() 发布所有
        ->addAlias(json_encode($topic->user_id))
        ->androidNotification('互动消息', array(
            'title' => 'hello jpush',
            'build_id' => 2,
            'extras' => json_encode($data),
        ))
        ->iosNotification('互动消息', array(
            'sound' => 'sound.caf',
            'content-available' => true,
            'mutable-content' => true,
            'extras' => json_encode($data),
        ))
        ->message(json_encode($data));
        try {
            $response = $push->send();
        } catch (\JPush\Exceptions\APIConnectionException $e) {
            // try something here
        } catch (\JPush\Exceptions\APIRequestException $e) {
            // try something here
        }
    }
}
