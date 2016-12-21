<?php

namespace App\Models;

use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Attribute\NotificationAttribute;
use App\Models\Traits\Relationship\NotificationRelationship;
use App\Hanlder\NotificationPresenter;

class Notification extends Model
{
    use NotificationAttribute, NotificationRelationship, NotificationPresenter;
    protected $fillable = ['type', 'notification_id', 'notification_type', 'data', 'action', 'sender'];

    public static function notificationFilter($query, $request)
    {
        if ($request->has('id')) {
            $query = $query->where('id', '=', $request->get('id'));
        }

        return $query;
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeWithType($query, $type)
    {
        return $query->where('type', '=', $type);
    }
}
