<?php

namespace App\Models\Comments\Traits\Relationship;

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
        return $this->belongsTo('App\Models\News\News');
    }
}
