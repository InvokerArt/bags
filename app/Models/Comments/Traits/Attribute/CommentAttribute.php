<?php

namespace App\Models\Comments\Traits\Attribute;

trait CommentAttribute
{
    //checkbox按钮
    public function getCheckboxButtonAttribute()
    {
        return '<input type="checkbox" name="id[]" value="'.$this->id.'">';
    }

    //操作按钮
    public function getActionButtonsAttribute()
    {
        
        return '<a href="' . route(env('APP_BACKEND_PREFIX').'.news.comments.edit', $this->id) . '" class="btn btn-xs blue"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> <a href="' . route(env('APP_BACKEND_PREFIX').'.news.comments.destroy', $this->id) . '" data-method="destroy" class="btn btn-xs red"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="移至回收站"></i></a>';
    }

    //如果是回复某一条评论
    public function getParentContentAttribute()
    {
        if ($this->parent_id) {
            $commentTo = $this->commentTo()->first();
            $commentToUser = $commentTo->user()->first();
            return '评论给 <a href="' . route(env('APP_BACKEND_PREFIX').'.users.edit', $this->parent_id) . '" target="_blank">'.$commentToUser->username.'</a>'.$this->content.'<a href="' . route(env('APP_BACKEND_PREFIX').'.news.comments.commentto', $this->id) . '">回复</a>';
        } else {
            return $this->content.'<a href="' . route(env('APP_BACKEND_PREFIX').'.news.comments.commentto', $this->id) . '">回复</a>';
        }
    }

    //评论标题链接
    public function getNewsUrlAttribute()
    {
        return '<a href="' . route(env('APP_BACKEND_PREFIX').'.news.edit', $this->commentable_id) . '" target="_blank">'.$this->commentable->title.'</a>';
    }
}
