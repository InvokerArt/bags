<?php

namespace App\Models\Access\User;

use App\Models\Access\User\Traits\Attribute\UserAttribute;
use App\Models\Access\User\Traits\Relationship\UserRelationship;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Laravel\Passport\HasApiTokens;

/**
 * App\Models\Access\User\User
 *
 * @property integer $id
 * @property string $name 用户名
 * @property string $mobile 手机号
 * @property string $email 邮箱
 * @property string $password 密码
 * @property string $avatar 头像
 * @property string $remember_token
 * @property boolean $status 用户状态 0禁用
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\Role\Role[] $roles
 * @property-read mixed $user_edit_button
 * @property-read mixed $user_delete_buttons
 * @property-read mixed $user_action_buttons
 * @property-read mixed $admin_edit_button
 * @property-read mixed $admin_delete_button
 * @property-read mixed $admin_action_buttons
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereMobile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereDeletedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable, EntrustUserTrait, UserAttribute, UserRelationship;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * 重写Checks if the user has a role by its name.
     *
     * @param string|array $name       Role name or array of role names.
     * @param bool         $requireAll All roles in the array are required.
     *
     * @return bool
     */
    public function hasRole($name, $requireAll = false)
    {
        if (is_array($name)) {
            foreach ($name as $roleName) {
                $hasRole = $this->hasRole($roleName);

                if ($hasRole && !$requireAll) {
                    return true;
                } elseif (!$hasRole && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the roles were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the roles were found.
            // Return the value of $requireAll;
            return $requireAll;
        } else {
            foreach ($this->cachedRoles() as $role) {
                if ($role->all) return true;//本地新增所有权限的判断
                if ($role->name == $name) {
                    return true;
                }
            }
        }

        return false;
    }


    /**
     * 重写Check if user has a permission by its name. 
     *
     * @param string|array $permission Permission string or array of permissions.
     * @param bool         $requireAll All permissions in the array are required.
     *
     * @return bool
     */
    public function can($permission, $requireAll = false)
    {
        if (is_array($permission)) {
            foreach ($permission as $permName) {
                $hasPerm = $this->can($permName);

                if ($hasPerm && !$requireAll) {
                    return true;
                } elseif (!$hasPerm && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the perms were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the perms were found.
            // Return the value of $requireAll;
            return $requireAll;
        } else {
            foreach ($this->cachedRoles() as $role) {
                if ($role->all) return true;//本地新增所有权限的判断
                // Validate against the Permission table
                foreach ($role->cachedPermissions() as $perm) {
                    if (str_is( $permission, $perm->name) ) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

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