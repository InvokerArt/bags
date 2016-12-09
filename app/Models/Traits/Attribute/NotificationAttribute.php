<?php

namespace App\Models\Traits\Attribute;

trait NotificationAttribute
{
    //操作按钮
    public function getActionButtonAttribute()
    {
        return '<a href="' . route(env('APP_BACKEND_PREFIX').'.notifications.destroy', $this->id) . '" data-method="destroy" class="btn btn-xs red"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="删除"></i></a>';
    }
}
