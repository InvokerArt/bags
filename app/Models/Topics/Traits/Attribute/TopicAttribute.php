<?php

namespace App\Models\Topics\Traits\Attribute;

trait TopicAttribute
{
    //checkbox按钮
    public function getCheckboxButtonAttribute()
    {
        return '<input type="checkbox" name="id[]" value="'.$this->id.'">';
    }

    //操作按钮
    public function getActionButtonsAttribute()
    {
        return '<a href="' . route(env('APP_BACKEND_PREFIX').'.topics.edit', $this->id) . '" class="btn btn-xs blue"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> <a href="' . route(env('APP_BACKEND_PREFIX').'.topics.destroy', $this->id) . '" data-method="destroy" class="btn btn-xs red"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="移至回收站"></i></a>';
    }

    public function setIsExcellentAttribute($value)
    {
        if (!$value) {
            $this->attributes['is_excellent'] = 'no';
        }
    }

    public function setIsBlockedAttribute($value)
    {
        if (!$value) {
            $this->attributes['is_blocked'] = 'no';
        }
    }

    public function setViewCountAttribute($value)
    {
        if (!$value) {
            $this->attributes['view_count'] = 0;
        }
    }

    public function setReplyCountAttribute($value)
    {
        if (!$value) {
            $this->attributes['reply_count'] = 0;
        }
    }

    public function setVoteCountAttribute($value)
    {
        if (!$value) {
            $this->attributes['vote_count'] = 0;
        }
    }
}
