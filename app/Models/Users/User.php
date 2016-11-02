<?php

namespace App\Models\Users;

use App\Models\Users\Traits\Attribute\UserAttribute;
use App\Models\Users\Traits\Relationship\UserRelationship;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, UserAttribute, UserRelationship;

    protected $fillable = [
        'id', 'username', 'name', 'mobile', 'email', 'password', 'avatar', 'status', 'created_at', 'updated_at'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function userFilter($query, $request)
    {
        if ($request->has('id')) {
            $query = $query->where('id', $request->get('id'));
        }

        if ($request->has('mobile')) {
            $query = $query->where('mobile', $request->get('mobile'));
        }

        if ($request->has('username')) {
            $query = $query->where('username', 'like', "%{$request->get('username')}%");
        }

        if ($request->has('email')) {
            $query = $query->where('email', $request->get('email'));
        }

        if ($request->has('created_from') && !$request->has('created_to')) {
            $query = $query->where('created_at', '>=', $request->get('created_from'));
        }

        if (!$request->has('created_from') && $request->has('created_to')) {
            $query = $query->where('created_at', '<=', $request->get('created_to'));
        }

        if ($request->has('created_from') && $request->has('created_to')) {
            $query = $query->whereBetween('created_at', [$request->get('created_from'),$request->get('created_to')]);
        }

        return $query;
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
