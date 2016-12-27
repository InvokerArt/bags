<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\Attribute\PermissionAttribute;
use App\Models\Traits\Relationship\PermissionRelationship;

class Permission extends Model
{
    use Notifiable, PermissionAttribute, PermissionRelationship;

    /**
     * 模型使用的数据库表
     *
     * @var string
     */
    protected $table;

    /**
     * 白名单
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description'];
    
    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('access.permissions_table');
    }
}
