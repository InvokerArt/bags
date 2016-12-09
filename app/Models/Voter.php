<?php

namespace App\Models;

use App\Hanlder\VotePush;
use App\Models\Topic;
use App\Models\User;
use App\Notifications\VoteNotification;
use Auth;

class Voter
{
    public static function topicUpVote(Topic $topic)
    {
        if ($topic->votes()->ByWhom(Auth::id())->WithType('upvote')->count()) {
            // click twice for remove upvote
            $topic->votes()->ByWhom(Auth::id())->WithType('upvote')->delete();
            $topic->decrement('vote_count', 1);
        } elseif ($topic->votes()->ByWhom(Auth::id())->WithType('downvote')->count()) {
            // user already clicked downvote once
            $topic->votes()->ByWhom(Auth::id())->WithType('downvote')->delete();
            $topic->votes()->create(['user_id' => Auth::id(), 'is' => 'upvote']);
            $topic->increment('vote_count', 2);
        } else {
            // first time click
            $topic->votes()->create(['user_id' => Auth::id(), 'is' => 'upvote']);
            $topic->increment('vote_count', 1);
            $fromUser = $topic->user()->first();
            foreach ($fromUser->unreadNotifications as $notification) {
                if ($topic->id == $notification->data['id']) {
                    return;
                }
            }
            $fromUser->notify(new VoteNotification($topic));
            VotePush::send($topic);
        }
    }

    public static function topicDownVote(Topic $topic)
    {
        if ($topic->votes()->ByWhom(Auth::id())->WithType('downvote')->count()) {
            // click second time for remove downvote
            $topic->votes()->ByWhom(Auth::id())->WithType('downvote')->delete();
            $topic->increment('vote_count', 1);
        } elseif ($topic->votes()->ByWhom(Auth::id())->WithType('upvote')->count()) {
            // user already clicked upvote once
            $topic->votes()->ByWhom(Auth::id())->WithType('upvote')->delete();
            $topic->votes()->create(['user_id' => Auth::id(), 'is' => 'downvote']);
            $topic->decrement('vote_count', 2);
        } else {
            // click first time
            $topic->votes()->create(['user_id' => Auth::id(), 'is' => 'downvote']);
            $topic->decrement('vote_count', 1);
        }
    }

    public function replyUpVote(Reply $reply)
    {
        if (Auth::id() == $reply->user_id) {
            return \Flash::warning(lang('Can not vote your feedback'));
        }

        $return = [];
        if ($reply->votes()->ByWhom(Auth::id())->WithType('upvote')->count()) {
            // click twice for remove upvote
            $reply->votes()->ByWhom(Auth::id())->WithType('upvote')->delete();
            $reply->decrement('vote_count', 1);
            $return['action_type'] = 'sub';
        } elseif ($reply->votes()->ByWhom(Auth::id())->WithType('downvote')->count()) {
            // user already clicked downvote once
            $reply->votes()->ByWhom(Auth::id())->WithType('downvote')->delete();
            $reply->votes()->create(['user_id' => Auth::id(), 'is' => 'upvote']);
            $reply->increment('vote_count', 2);
            $return['action_type'] = 'add';
        } else {
            // first time click
            $reply->votes()->create(['user_id' => Auth::id(), 'is' => 'upvote']);
            $reply->increment('vote_count', 1);
            $return['action_type'] = 'add';

            Notification::notify('reply_upvote', Auth::user(), $reply->user, $reply->topic, $reply);
        }
        return $return;
    }
}
