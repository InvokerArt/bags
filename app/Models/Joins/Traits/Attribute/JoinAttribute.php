<?php

namespace App\Models\Joins\Traits\Attribute;

trait JoinAttribute
{
    //checkbox按钮
    public function getCheckboxButtonAttribute()
    {
        return '<input type="checkbox" name="id[]" value="'.$this->id.'">';
    }

    //操作按钮
    public function getActionButtonsAttribute()
    {
        
        return '<a href="' . route(env('APP_BACKEND_PREFIX').'.joins.edit', $this->id) . '" class="btn btn-xs blue"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> <a href="' . route(env('APP_BACKEND_PREFIX').'.joins.destroy', $this->id) . '" data-method="destroy" class="btn btn-xs red"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="删除"></i></a>';
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

    //设置状态存储器
    public function setStatusAttribute($value)
    {
        if (!$value) {
            $this->attributes['status'] = 1;
        } else {
            $this->attributes['status'] = $value;
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

    public function getStatusButtonAttribute()
    {
        switch ($this->status) {
            case 0:
                return '<span class="label label-sm label-danger">驳回</span>';
                break;
            case 1:
                return '<span class="label label-sm label-info">待审核</span>';
                break;
            case 2:
                return '<span class="label label-sm label-success">通过</span>';
                break;
        }
    }
}
