<?php

namespace App\Repositories\Backend\Comments;

use App\Exceptions\GeneralException;
use App\Models\Comment;
use App\Models\News;
use DB;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class CommentRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = Comment::class;

    public function getForDataTable()
    {
        return $this->query()->with(['user', 'commentable']);
    }

    public function create($input)
    {
        $comment = self::MODEL;
        $comment = new $comment;
        $news = News::find($input['news_id']);
        if (!$news) {
            throw new GeneralException("添加失败，评论新闻不存在！");
        }
        if ($input['parent_id']) {
            //查询评论新闻和用户是否存在
            $commentReady = $this->query()->where('commentable_id', $input['news_id'])->where('id', $input['parent_id'])->first();
            if (!$commentReady) {
                throw new GeneralException("添加失败，评论用户不存在！");
            }
            $comment->parent_id = $input['parent_id'];
        }

        DB::transaction(function () use ($news, $comment) {
            if ($news->comments()->save($comment)) {
                $news->comment_count++;
                $news->save();
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Model $comment, array $input)
    {
        $news = News::find($input['news_id']);
        if (!$news) {
            throw new GeneralException("添加失败，评论新闻不存在！");
        }
        if ($input['parent_id']) {
            //查询评论新闻和用户是否存在
            $commentReady = $this->query()->where('commentable_id', $input['news_id'])->where('id', $input['parent_id'])->first();
            if (!$commentReady) {
                throw new GeneralException("添加失败，评论用户不存在！");
            }
            $comment->parent_id = $input['parent_id'];
        }

        DB::transaction(function () use ($comment, $input) {
            if (parent::update($comment, $input)) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy(Model $comment)
    {
        if (parent::delete($comment)) {
            $comment->commentable()->decrement('comment_count', 1);
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore(Model $comment)
    {
        if (parent::restore($comment)) {
            $comment->commentable()->increment('comment_count', 1);
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete(Model $comment)
    {
        if (parent::forceDelete($comment)) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }
}
