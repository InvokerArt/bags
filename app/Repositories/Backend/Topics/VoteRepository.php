<?php

namespace App\Repositories\Backend\Topics;

use App\Models\Notification;
use App\Repositories\Backend\Notifications\NotificationInterface;
use Auth;

class VoteRepository implements VoteInterface
{
    protected $notification;

    public function __construct(NotificationInterface $notification)
    {
        $this->notification = $notification;
    }

    public function create($input)
    {
        if ($input->votes()->ByWhom(Auth::id())->WithType($input->action)->count()) {
            // 已经点过赞
            $input->votes()->ByWhom(Auth::id())->WithType($input->action)->delete();
            $input->decrement('vote_count', 1);
        } else {
            // 第一次点击
            $input->votes()->create(['user_id' => Auth::id(), 'is' => $input->action]);
            $input->increment('vote_count', 1);
            $input->type =  get_class($input);
            $input->id = $input->topic_id;
            $this->notification->createPersonal($input);
        }
    }
}
