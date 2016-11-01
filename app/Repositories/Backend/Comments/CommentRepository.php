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
            $commentReady = Comment::where('commentable_id', $input['news_id'])->where('id', $input['parent_id'])->first();
            if (!$commentReady) {
                throw new GeneralException("添加失败，评论用户不存在！");
            }
            $comment->parent_id = $input['parent_id'];
        }
        $comment->content = $input['content'];
        $comment->is_blocked = $input['is_blocked'];
        $comment->user_id = $input['user_id'];

        DB::transaction(function () use ($news, $comment) {
            if ($news->comments()->save($comment)) {
                $news->comment_count++;
                $news->save();
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Comment $comment, $input)
    {
        $news = News::find($input['news_id']);
        if (!$news) {
            throw new GeneralException("添加失败，评论新闻不存在！");
        }
        if ($input['parent_id']) {
            //查询评论新闻和用户是否存在
            $commentReady = Comment::where('commentable_id', $input['news_id'])->where('id', $input['parent_id'])->first();
            if (!$commentReady) {
                throw new GeneralException("添加失败，评论用户不存在！");
            }
            $comment->parent_id = $input['parent_id'];
        }
        $comment->content = $input['content'];
        $comment->is_blocked = $input['is_blocked'];
        $comment->user_id = $input['user_id'];

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
            $comment->commentable()->decrement('comment_count', 1);
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore($id)
    {
        $comment = $this->findOrThrowException($id);
        if ($comment->restore()) {
            $comment->commentable()->increment('comment_count', 1);
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
