<?php

namespace App\Models\News\Traits\Relationship;

trait NewsRelationship
{

    //分类多对多
    public function categories()
    {
        return $this->belongsToMany('App\Models\News\CategoriesNews', 'category_new', 'news_id', 'category_id');
    }

    //用户一对多反向
    public function user()
    {
        return $this->belongsTo('App\Models\Access\User\User');
    }

    //标签多对多的多态关联
    public function tags()
    {
        return $this->morphToMany('App\Models\Tags\Tag', 'taggable');
    }

    //评论一对多
    public function comments()
    {
        return $this->morphMany('App\Models\Comments\Comment', 'commentable');
    }

    //添加标签数据到中间表
    public function attachTag($tag)
    {
        if (is_object($tag)) {
            $tag = $tag->getKey();
        }

        if (is_array($tag)) {
            $tag = $tag['id'];
        }

        $this->tags()->attach($tag);
    }

    //添加标签数据到中间表
    public function attachTags($tags)
    {
        foreach ($tags as $tag) {
            $this->attachTag($tag);
        }
    }

    //更新标签数据到中间表
    public function syncTags($tags)
    {
        $this->tags()->sync($tags);
    }


    //添加分类数据到中间表
    public function attachCategory($Category)
    {
        if (is_object($Category)) {
            $Category = $Category->getKey();
        }

        if (is_array($Category)) {
            $Category = $Category['id'];
        }

        $this->Categories()->attach($Category);
    }

    //添加分类数据到中间表
    public function attachCategories($Categories)
    {
        foreach ($Categories as $Category) {
            $this->attachCategory($Category);
        }
    }

    //更新分类数据到中间表
    public function syncCategories($Categories)
    {
        $this->Categories()->sync($Categories);
    }
}
