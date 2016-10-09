<?php

namespace App\Models\Access\User\Traits\Attribute;

use Config;
use Image;

/**
 * Class UserAttribute
 * @package App\Models\Access\User\Traits\Attribute
 */
trait UserAttribute
{

    /**
     * @return string
     */
    public function getUserEditButtonAttribute()
    {
        //创始人不能编辑
        if ($this->id>1) {
            return '<a href="' . route(env('APP_BACKEND_PREFIX').'.access.user.edit', $this->id) . '" class="btn btn-xs blue"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getUserDeleteButtonsAttribute()
    {
        //创始人不能编辑
        if ($this->id>1) {
            return '<a href="' . route(env('APP_BACKEND_PREFIX').'.access.user.destroy', $this->id) . '" data-method="delete" class="btn btn-xs red"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="删除"></i></a>';
        }

        return '';
    }

    /**
     * 用户按钮
     * @return string
     */
    public function getUserActionButtonsAttribute()
    {
        return $this->getUserEditButtonAttribute() .
        $this->getUserDeleteButtonAttribute();
    }

    /**
     * @return string
     */
    public function getAdminEditButtonAttribute()
    {
        //创始人不能编辑
        if ($this->id>1) {
            return '<a href="' . route(env('APP_BACKEND_PREFIX').'.access.admin.edit', $this->id) . '" class="btn btn-xs blue"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getAdminDeleteButtonAttribute()
    {
        //创始人不能编辑
        if ($this->id>1) {
            return '<a href="' . route(env('APP_BACKEND_PREFIX').'.access.admin.destroy', $this->id) . '" data-method="delete" class="btn btn-xs red"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="删除"></i></a>';
        }

        return '';
    }

    /**
     * 管理员按钮
     * @return string
     */
    public function getAdminActionButtonsAttribute()
    {
        return $this->getAdminEditButtonAttribute() .
        $this->getAdminDeleteButtonAttribute();
    }
}
