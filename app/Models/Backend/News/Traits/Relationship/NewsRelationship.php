<?php

namespace App\Models\Backend\News\Traits\Relationship;

trait NewsRelationship
{

    //分类多对多
    public function categories()
    {
        return $this->belongsToMany('App\Models\Backend\News\CategoriesNews', 'category_new', 'news_id', 'category_id');
    }

    //用户一对多反向
    public function user()
    {
        return $this->belongsTo('App\Models\Access\User\User');
    }

    //标签多对多的多态关联
    public function tags()
    {
        return $this->morphToMany('App\Models\Backend\Tags\Tag', 'taggable');
    }

    //评论一对多
    public function comments()
    {
        return $this->morphMany('App\Models\Backend\Comments\Comment', 'commentable');
    }
}
