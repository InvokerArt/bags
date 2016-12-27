<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\RoleAccess;
use App\Models\Traits\Attribute\RoleAttribute;
use App\Models\Traits\Relationship\RoleRelationship;

class Role extends Model
{
	use Notifiable, RoleAccess, RoleAttribute, RoleRelationship;

    /**
     * 模型使用的数据库表
     *
     * @var string
     */
    protected $table;

    /**
     * 白名单
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description', 'all', 'sort'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('access.roles_table');
    }
}