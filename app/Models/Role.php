<?php 

namespace App\Models;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\RoleAccess;
use App\Models\Traits\Attribute\RoleAttribute;
use App\Models\Traits\Relationship\RoleRelationship;

class Role extends EntrustRole
{
	use Notifiable, RoleAccess, RoleAttribute, RoleRelationship;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description', 'all', 'sort'];
}