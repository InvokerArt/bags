<?php

namespace App\Models\Companies\Traits\Attribute;

trait CompanyAttribute
{
    //checkbox按钮
    public function getCheckboxButtonAttribute()
    {
        return '<input type="checkbox" name="id[]" value="'.$this->id.'">';
    }

    //操作按钮
    public function getActionButtonsAttribute()
    {
        
        return '<a href="' . route(env('APP_BACKEND_PREFIX').'.companies.edit', $this->id) . '" class="btn btn-xs blue"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> <a href="' . route(env('APP_BACKEND_PREFIX').'.companies.destroy', $this->id) . '" data-method="delete" class="btn btn-xs red"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="删除"></i></a>';
    }

    //设置公司营业执照存储器
    public function setLicensesAttribute($value)
    {
        if ($value) {
            $this->attributes['licenses'] = json_encode(serialize($value));
        }
    }

    //设置公司营业执照访问器
    public function getLicensesAttribute($value)
    {
        if ($value) {
            return unserialize(json_decode($value));
        } else {
            return [];
        }
    }

    //设置公司照片存储器
    public function setPhotosAttribute($value)
    {
        if ($value) {
            $this->attributes['photos'] = json_encode(serialize($value));
        }
    }

    //设置公司照片访问器
    public function getPhotosAttribute($value)
    {
        if ($value) {
            return unserialize(json_decode($value));
        } else {
            return [];
        }
    }
}
