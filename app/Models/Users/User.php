<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\Traits\Attribute\UserAttribute;
use App\Models\Users\Traits\Relationship\UserRelationship;

class User extends Model
{
    use UserAttribute, UserRelationship;

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
}
