<?php

namespace App\Models;

use App\Models\Traits\Attribute\AdminAttribute;
use App\Models\Traits\Relationship\AdminRelationship;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\Traits\UserAccess;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use UserAccess, HasApiTokens, Notifiable, SoftDeletes, AdminAttribute, AdminRelationship;

    /**
     * 模型使用的数据库表
     * @var string
     */
    protected $table = 'users';
    
    /**
     * 数据白名单
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'mobile', 'email', 'password', 'avatar', 'status', 'created_at', 'updated_at'
    ];
    /**
     * 隐藏属性
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * 修改Passport 认证方式为手机
     *
     * @param $username
     * @return object
     */
    public function findForPassport($username)
    {
        return User::where('mobile', $username)->first();
    }
}
