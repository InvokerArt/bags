<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Model;
use App\Models\Notifications\Traits\Relationship\NotificationUserRelationship;

class NotificationUser extends Model
{
    use NotificationUserRelationship;

    protected $table = 'notification_user';

    protected $fillable = ['user_id', 'notification_id', 'read_at'];

    protected $casts = [
        'read_at' => 'datetime',
    ];
}
