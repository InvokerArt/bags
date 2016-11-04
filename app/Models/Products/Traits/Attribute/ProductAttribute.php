<?php

namespace App\Models\Products\Traits\Attribute;

trait ProductAttribute
{
    //checkbox按钮
    public function getCheckboxButtonAttribute()
    {
        return '<input type="checkbox" name="id[]" value="'.$this->id.'">';
    }

    //操作按钮
    public function getActionButtonsAttribute()
    {
        return '<a href="' . route(env('APP_BACKEND_PREFIX').'.products.edit', $this->id) . '" class="btn btn-xs blue"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> <a href="' . route(env('APP_BACKEND_PREFIX').'.products.destroy', $this->id) . '" data-method="destroy" class="btn btn-xs red"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="移至回收站"></i></a>';
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

    //产品里面插入公司信息
    public function getInsertCompanyAttribute()
    {
        $company = $this->company()->first();
        $this->address = $company->address;
        $this->addressDetail = $company->addressDetail;
        $this->telephone = $company->telephone;
        return $this;
    }
}
