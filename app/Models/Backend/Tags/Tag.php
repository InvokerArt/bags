<?php

namespace App\Models\Backend\Tags;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    //所属标签的新闻多对多的多态关联反向
    public function news()
    {
        return $this->morphedByMany('App\Models\Backend\News\News', 'taggable');
    }

    //checkbox按钮
    public function getCheckboxButtonAttribute()
    {
        return '<input type="checkbox" name="id[]" value="'.$this->id.'">';
    }

    //操作按钮
    public function getActionButtonsAttribute()
    {
        
        return '<a href="' . route(env('APP_BACKEND_PREFIX').'.tags.edit', $this->id) . '" class="btn btn-xs blue"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> <a href="' . route(env('APP_BACKEND_PREFIX').'.tags.destroy', $this->id) . '" data-method="delete" class="btn btn-xs red"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="删除"></i></a>';
    }
}
