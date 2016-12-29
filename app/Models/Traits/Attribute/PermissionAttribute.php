<?php

namespace App\Models\Traits\Attribute;

/**
 * Class RoleAttribute
 * @package App\Models\Access\Permission\Traits\Attribute
 */
trait PermissionAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        //系统权限不能编辑
        if ($this->id > 3) {
            return '<a href="' . route(env('APP_BACKEND_PREFIX').'.access.permission.edit', $this) . '" class="btn btn-xs blue"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> ';
        }
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        //系统权限不能编辑
        if ($this->id > 3) {
            return '<a href="' . route(env('APP_BACKEND_PREFIX').'.access.permission.destroy', $this) . '" class="btn btn-xs red" data-method="destroy"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="删除"></i></a>';
        }

        return '';
    }

    /**
     * 操作按钮
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getEditButtonAttribute() .
        $this->getDeleteButtonAttribute();
    }
}
