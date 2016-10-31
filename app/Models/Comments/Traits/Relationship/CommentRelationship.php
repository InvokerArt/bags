<?php

namespace App\Models\Comments\Traits\Relationship;

trait CommentRelationship
{
    //用户一对多反向
    public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

    //评论一对多反向
    public function commentable()
    {
        return $this->morphTo();
    }

    //评论一对一反向
    public function commentToUser()
    {
        return $this->belongsTo('App\Models\Users\User', 'parent_id');
    }
}
