<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Model;
use App\Models\Notifications\Traits\Attribute\NotificationAttribute;
use App\Models\Notifications\Traits\Relationship\NotificationRelationship;

class Notification extends Model
{
    use NotificationAttribute, NotificationRelationship;

    protected $fillable = ['type', 'notification_id', 'notification_type', 'data', 'action', 'sender'];

    public static function notificationFilter($query, $request)
    {
        if ($request->has('id')) {
            $query = $query->where('id', '=', $request->get('id'));
        }

        return $query;
    }
}
