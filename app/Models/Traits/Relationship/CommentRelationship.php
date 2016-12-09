<?php

namespace App\Models\Traits\Relationship;

trait CommentRelationship
{
    //用户一对多反向
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    //评论一对多反向
    public function commentable()
    {
        return $this->morphTo();
    }

    //评论一对一反向
    public function commentTo()
    {
        return $this->belongsTo('App\Models\comment', 'parent_id');
    }
}
