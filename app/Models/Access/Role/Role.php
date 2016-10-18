<?php 

namespace App\Models\Access\Role;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Notifications\Notifiable;
use App\Models\Access\Role\Traits\RoleAccess;
use App\Models\Access\Role\Traits\Attribute\RoleAttribute;
use App\Models\Access\Role\Traits\Relationship\RoleRelationship;

/**
 * App\Models\Access\Role\Role
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property boolean $all
 * @property integer $sort
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\User\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\Permission\Permission[] $perms
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @property-read mixed $edit_button
 * @property-read mixed $delete_button
 * @property-read mixed $action_buttons
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\Permission\Permission[] $permissions
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Role\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Role\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Role\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Role\Role whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Role\Role whereAll($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Role\Role whereSort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Role\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Role\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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