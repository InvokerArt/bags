<?php

namespace App\Models\Topics\Traits\Relationship;

trait TopicRelationship
{
    //分类一对一
    public function categories()
    {
        return $this->belongsTo('App\Models\Topics\CategoriesTopics', 'category_id');
    }

    //用户一对多反向
    public function user()
    {
        return $this->belongsTo('App\Models\Access\User\User');
    }

    //评论一对多
    public function replies()
    {
        return $this->hasMany('App\Models\Topics\Repliy');
    }
}
