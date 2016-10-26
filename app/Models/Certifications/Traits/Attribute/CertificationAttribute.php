<?php

namespace App\Models\Certifications\Traits\Attribute;

trait CertificationAttribute
{
    //checkbox按钮
    public function getCheckboxButtonAttribute()
    {
        return '<input type="checkbox" name="id[]" value="'.$this->id.'">';
    }

    //操作按钮
    public function getActionButtonsAttribute()
    {
        
        return '<a href="' . route(env('APP_BACKEND_PREFIX').'.certifications.edit', $this->id) . '" class="btn btn-xs blue"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> <a href="' . route(env('APP_BACKEND_PREFIX').'.certifications.destroy', $this->id) . '" data-method="destroy" class="btn btn-xs red"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="删除"></i></a>';
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

    //设置身份证存储器
    public function setIdentityCardAttribute($value)
    {
        if ($value) {
            $this->attributes['identity_card'] = json_encode(serialize($value));
        }
    }

    //设置身份证访问器
    public function getIdentityCardAttribute($value)
    {
        if ($value) {
            return unserialize(json_decode($value));
        } else {
            return [];
        }
    }
}
