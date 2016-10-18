<?php 

namespace App\Models\Access\Permission;

use Zizaco\Entrust\EntrustPermission;
use Illuminate\Notifications\Notifiable;
use App\Models\Access\Permission\Traits\Attribute\PermissionAttribute;
use App\Models\Access\Permission\Traits\Relationship\PermissionRelationship;

/**
 * App\Models\Access\Permission\Permission
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\Role\Role[] $roles
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @property-read mixed $edit_button
 * @property-read mixed $delete_button
 * @property-read mixed $action_buttons
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Permission\Permission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Permission\Permission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Permission\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Permission\Permission whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Permission\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\Permission\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permission extends EntrustPermission
{
	use Notifiable, PermissionAttribute, PermissionRelationship;

	/**
	 * 白名单
	 * @var array
	 */
	protected $fillable = ['name', 'display_name', 'description'];
}