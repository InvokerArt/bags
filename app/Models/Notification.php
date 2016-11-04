<?php

namespace App\Models;

use App\Models\Topics\Reply;
use App\Models\Topics\Topic;
use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['id', 'type','notifiable_id', 'notifiable_type', 'data', 'read_at', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

    public function topic()
    {
        return $this->belongsTo('App\Models\Topics\Topic');
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
