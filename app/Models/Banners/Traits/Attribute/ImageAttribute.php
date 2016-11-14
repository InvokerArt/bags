<?php

namespace App\Models\Banners\Traits\Attribute;

use Carbon\Carbon;
use Storage;

trait ImageAttribute
{
    //checkbox按钮
    public function getCheckboxButtonAttribute()
    {
        return '<input type="checkbox" name="id[]" value="'.$this->id.'">';
    }

    //操作按钮
    public function getActionButtonsAttribute()
    {
        return '<a href="' . route(env('APP_BACKEND_PREFIX').'.banners.image.edit', $this->id) . '" class="btn btn-xs blue"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> <a href="' . route(env('APP_BACKEND_PREFIX').'.banners.image.destroy', $this->id) . '" data-method="destroy" class="btn btn-xs red"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="移至回收站"></i></a>';
    }

    //缩略图
    public function getImageSrcAttribute()
    {
        return '<a href="'.Storage::url($this->image_url).'" data-toggle="lightbox"><img src="'.Storage::url($this->image_url).'" style="max-width:40px;max-height:32px;"></a>';
    }

    //大图
    public function getImageLargeSrcAttribute()
    {
        return '<a href="'.Storage::url($this->image_url).'" data-toggle="lightbox"><img src="'.Storage::url($this->image_url).'" style="max-width:640px;max-height:320px;margin-bottom:10px;"></a>';
    }

    public function setPublishedFromAttribute($date)
    {
        $this->attributes['published_from'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    public function setPublishedToAttribute($date)
    {
        $this->attributes['published_to'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    //设置图片路径访问器
    public function getImageUrlAttribute($value)
    {
        return asset(Storage::url($value));
    }
}
