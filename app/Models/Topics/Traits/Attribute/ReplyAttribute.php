<?php

namespace App\Models\Topics\Traits\Attribute;

trait ReplyAttribute
{
    //checkbox按钮
    public function getCheckboxButtonAttribute()
    {
        return '<input type="checkbox" name="id[]" value="'.$this->id.'">';
    }

    //操作按钮
    public function getActionButtonsAttribute()
    {
        
        return '<a href="' . route(env('APP_BACKEND_PREFIX').'.replies.edit', $this->id) . '" class="btn btn-xs blue"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> <a href="' . route(env('APP_BACKEND_PREFIX').'.replies.destroy', $this->id) . '" data-method="destroy" class="btn btn-xs red"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="移至回收站"></i></a>';
    }

    //如果是回复某一条评论
    public function getParentContentAttribute()
    {
        if ($this->parent_id) {
            $replyToUser = $this->replyToUser()->first();
            return '回复给 <a href="' . route(env('APP_BACKEND_PREFIX').'.users.edit', $this->parent_id) . '" target="_blank">'.$replyToUser->username.'</a>'.$this->content;
        } else {
            return $this->content;
        }
    }

    //话题标题链接
    public function getTopicUrlAttribute()
    {
        
        return '<a href="' . route(env('APP_BACKEND_PREFIX').'.topics.edit', $this->topic_id) . '" target="_blank">'.$this->title.'</a>';
    }
}
