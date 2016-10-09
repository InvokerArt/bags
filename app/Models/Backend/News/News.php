<?php

namespace App\Models\Backend\News;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * 默认数据库
     * @var string
     */
    protected $table = 'news';

    /**
     * 发布日期属性
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * 参数黑名单
     * @var array
     */
    protected $guard = [
        'user_id',
    ];

    //checkbox按钮
    public function getCheckboxButtonAttribute()
    {
        return '<input type="checkbox" name="id[]" value="'.$this->id.'">';
    }

    //操作按钮
    public function getActionButtonsAttribute()
    {
        
        return '<a href="' . route(env('APP_BACKEND_PREFIX').'.news.edit', $this->id) . '" class="btn btn-xs blue"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> <a href="' . route(env('APP_BACKEND_PREFIX').'.news.destroy', $this->id) . '" data-method="delete" class="btn btn-xs red"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="移至回收站"></i></a>';
    }

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
