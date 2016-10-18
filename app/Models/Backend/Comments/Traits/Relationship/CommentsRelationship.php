<?php

namespace App\Models\Backend\Comments\Traits\Relationship;

trait CommentsRelationship
{
    //用户一对多反向
    public function user()
    {
        return $this->belongsTo('App\Models\Access\User\User');
    }

    //评论一对多反向
    public function news()
    {
        return $this->belongsTo('App\Models\Backend\News\News');
    }
}
