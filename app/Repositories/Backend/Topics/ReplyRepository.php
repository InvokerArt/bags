<?php

namespace App\Repositories\Backend\Topics;

use App\Exceptions\GeneralException;
use App\Models\Topics\Reply;
use App\Models\Topics\ReplyCategory;
use DB;
use Auth;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class ReplyRepository implements ReplyInterface
{
    public function getForDataTable()
    {
        return Reply::select('replies.*', 'topics.title as title', 'users.username as username')
        ->leftJoin('topics', 'topics.id', 'replies.topic_id')
        ->leftJoin('users', 'users.id', 'replies.user_id');
    }

    public function create($input)
    {
        $reply = new Reply;
        $topic = Topic::find($input['topic_id']);
        if (!$topic) {
            throw new GeneralException("添加失败，回复话题不存在！");
        }
        if ($input['parent_id']) {
            //查询回复话题和用户是否存在
            $replyReady = Reply::where('topic_id', $input['topic_id'])->where('user_id', $input['parent_id'])->first();
            if ($replyReady) {
                $reply->parent_id = $replyReady->id;
            } else {
                throw new GeneralException("添加失败，回复用户不存在！");
            }
        }
        $reply->content = $input['content'];
        $reply->topic_id = $input['topic_id'];
        $reply->user_id = $input['user_id'];
        $reply->is_blocked = $input['is_blocked'];
        $reply->vote_count = $input['vote_count'];

        DB::transaction(function () use ($reply) {
            if ($reply->save()) {
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Reply $reply, $input)
    {
        $topic = Topic::find($input['topic_id']);
        if (!$topic) {
            throw new GeneralException("更新失败，回复话题不存在！");
        }
        if ($input['parent_id']) {
            //查询回复话题和用户是否存在
            $replyReady = Reply::where('topic_id', $input['topic_id'])->where('user_id', $input['parent_id'])->first();
            if ($replyReady) {
                $reply->parent_id = $replyReady->id;
            } else {
                throw new GeneralException("更新失败，回复用户不存在！");
            }
        }
        $reply->content = $input['content'];
        $reply->topic_id = $input['topic_id'];
        $reply->user_id = $input['user_id'];
        $reply->is_blocked = $input['is_blocked'];
        $reply->vote_count = $input['vote_count'];

        DB::transaction(function () use ($reply) {
            if ($reply->update()) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy($id)
    {
        $reply = $this->findOrThrowException($id);
        if ($reply->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore($id)
    {
        $reply = $this->findOrThrowException($id);
        if ($reply->restore()) {
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete($id)
    {
        $reply = $this->findOrThrowException($id);
        if ($reply->forceDelete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function findOrThrowException($id)
    {
        $demand = Reply::withTrashed()->find($id);

        if (!is_null($demand)) {
            return $demand;
        }

        throw new GeneralException('未找到需求信息');
    }
}
