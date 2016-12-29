<?php

namespace App\Repositories\Backend\Topics;

use App\Exceptions\GeneralException;
use App\Models\Reply;
use App\Models\Topic;
use App\Repositories\Backend\Notifications\NotificationRepository;
use DB;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class ReplyRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = Reply::class;

    private $notification;

    public function __construct(NotificationRepository $notification)
    {
        $this->notification = $notification;
    }

    public function getForDataTable()
    {
        return $this->query()->select('replies.*', 'topics.title as title', 'users.username as username')
        ->leftJoin('topics', 'topics.id', 'replies.topic_id')
        ->leftJoin('users', 'users.id', 'replies.user_id');
    }

    public function create($input)
    {
        $reply = self::MODEL;
        $reply = new $reply;
        $topic = Topic::find($input['topic_id']);
        if (!$topic) {
            throw new GeneralException("添加失败，回复话题不存在！");
        }
        if ($input['parent_id']) {
            //查询回复话题和用户是否存在
            $replyReady = $this->query()->where('topic_id', $input['topic_id'])->where('id', $input['parent_id'])->first();
            if (!$replyReady) {
                throw new GeneralException("添加失败，回复用户不存在！");
            }
            $reply->parent_id = $input['parent_id'];
        }
        $reply->content = $input['content'];
        $reply->topic_id = $input['topic_id'];
        $reply->user_id = $input['user_id'];
        $reply->is_blocked = $input['is_blocked'];
        $reply->vote_count = $input['vote_count'];

        DB::transaction(function () use ($reply, $topic, $input) {
            if (parent::save($reply)) {
                $topic->reply_count++;
                $topic->last_reply_user_id = $reply->user_id;
                $topic->save();
                if ($input['action']) {
                    $topic->type =  'App\Models\Topic';
                    $topic->action = $input['action'];
                    $this->notification->createPersonal($topic);
                }
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Model $reply, array $input)
    {
        $topic = Topic::find($input['topic_id']);
        if (!$topic) {
            throw new GeneralException("添加失败，回复话题不存在！");
        }
        if ($input['parent_id']) {
            //查询回复话题和用户是否存在
            $replyReady = $this->query()->where('topic_id', $input['topic_id'])->where('id', $input['parent_id'])->first();
            if (!$replyReady) {
                throw new GeneralException("添加失败，回复用户不存在！");
            }
            $reply->parent_id = $input['parent_id'];
        }

        DB::transaction(function () use ($reply, $topic, $input) {
            if (parent::update($reply, $input)) {
                $topic->last_reply_user_id = $reply->user_id;
                $topic->save();
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy(Model $reply)
    {
        if (parent::delete($reply)) {
            $reply->topic()->decrement('reply_count', 1);
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore(Model $reply)
    {
        if (parent::restore($reply)) {
            $reply->topic()->increment('reply_count', 1);
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete(Model $reply)
    {
        if (parent::forceDelete($reply)) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }
}
