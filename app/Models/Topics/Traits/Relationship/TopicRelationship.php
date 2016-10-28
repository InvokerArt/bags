<?php

namespace App\Models\Topics\Traits\Relationship;

trait TopicRelationship
{

    //分类多对多
    public function categories()
    {
        return $this->belongsTo('App\Models\Topics\CategoriesTopics');
    }

    //用户一对多反向
    public function user()
    {
        return $this->belongsTo('App\Models\Access\User\User');
    }

    //评论一对多
    public function comments()
    {
        return $this->morphMany('App\Models\Comments\Comment', 'commentable');
    }
}
