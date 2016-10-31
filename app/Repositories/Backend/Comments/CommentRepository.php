<?php

namespace App\Repositories\Backend\Comments;

use App\Exceptions\GeneralException;
use App\Models\Comments\Comment;
use App\Models\News\News;
use DB;

class CommentRepository implements CommentInterface
{
    public function getForDataTable()
    {
        return Comment::with(['user', 'commentable']);
    }

    public function create($input)
    {
        $comment = new Comment;
        $news = News::find($input['news_id']);
        if (!$news) {
            throw new GeneralException("添加失败，评论新闻不存在！");
        }
        if ($input['parent_id']) {
            //查询评论新闻和用户是否存在
            $commentReady = Comment::where('news_id', $input['news_id'])->where('user_id', $input['parent_id'])->first();
            if ($commentReady) {
                $comment->parent_id = $commentReady->id;
            } else {
                throw new GeneralException("添加失败，评论用户不存在！");
            }
        }
        $comment->content = $input['content'];
        $comment->is_blocked = $input['is_blocked'];
        $comment->user_id = $input['user_id'];
        DB::transaction(function () use ($news, $comment) {
            if ($news->comments()->save($comment)) {
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Comment $comment, $input)
    {
        $topic = Topic::find($input['news_id']);
        if (!$topic) {
            throw new GeneralException("更新失败，评论新闻不存在！");
        }
        if ($input['parent_id']) {
            //查询评论新闻和用户是否存在
            $commentReady = Comment::where('news_id', $input['news_id'])->where('user_id', $input['parent_id'])->first();
            if ($commentReady) {
                $comment->parent_id = $commentReady->id;
            } else {
                throw new GeneralException("更新失败，评论用户不存在！");
            }
        }
        $comment->content = $input['content'];
        $comment->news_id = $input['news_id'];
        $comment->user_id = $input['user_id'];
        $comment->is_blocked = $input['is_blocked'];
        $comment->vote_count = $input['vote_count'];

        DB::transaction(function () use ($comment) {
            if ($comment->update()) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy($id)
    {
        $comment = $this->findOrThrowException($id);
        if ($comment->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore($id)
    {
        $comment = $this->findOrThrowException($id);
        if ($comment->restore()) {
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete($id)
    {
        $comment = $this->findOrThrowException($id);
        if ($comment->forceDelete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function findOrThrowException($id)
    {
        $demand = Comment::withTrashed()->find($id);

        if (!is_null($demand)) {
            return $demand;
        }

        throw new GeneralException('未找到需求信息');
    }
}
