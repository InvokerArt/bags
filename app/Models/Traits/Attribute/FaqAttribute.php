<?php

namespace App\Models\Traits\Attribute;

trait FaqAttribute
{
    //checkbox按钮
    public function getCheckboxButtonAttribute()
    {
        return '<input type="checkbox" name="id[]" value="'.$this->id.'">';
    }

    //操作按钮
    public function getActionButtonsAttribute()
    {
        return '<a href="' . route(env('APP_BACKEND_PREFIX').'.faqs.edit', $this->id) . '" class="btn btn-xs blue"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> <a href="' . route(env('APP_BACKEND_PREFIX').'.faqs.destroy', $this->id) . '" data-method="destroy" class="btn btn-xs red"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="删除"></i></a>';
    }
}
