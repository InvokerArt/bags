<?php

namespace App\Models\Traits\Attribute;

trait DemandAttribute
{
    //checkbox按钮
    public function getCheckboxButtonAttribute()
    {
        return '<input type="checkbox" name="id[]" value="'.$this->id.'">';
    }

    //操作按钮
    public function getActionButtonsAttribute()
    {
        return '<a href="' . route(env('APP_BACKEND_PREFIX').'.demands.edit', $this->id) . '" class="btn btn-xs blue"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> <a href="' . route(env('APP_BACKEND_PREFIX').'.demands.destroy', $this->id) . '" data-method="destroy" class="btn btn-xs red"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="移至回收站"></i></a>';
    }

    //设置产品照片存储器
    public function setImagesAttribute($value)
    {
        if ($value) {
            $this->attributes['images'] = json_encode(serialize($value));
        }
    }

    //设置产品照片访问器
    public function getImagesAttribute($value)
    {
        if ($value) {
            return unserialize(json_decode($value));
        } else {
            return [];
        }
    }

    public function setIsExcellentAttribute($value)
    {
        if (!$value) {
            $this->attributes['is_excellent'] = 'no';
        } else {
            $this->attributes['is_excellent'] = $value;
        }
    }
}
