<?php

namespace App\Models\Traits\Relationship;

trait NotificationRelationship
{
    public function notificationUser()
    {
        return $this->hasOne('App\Models\NotificationUser');
    }
    
    public function notification()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function topic()
    {
        return $this->belongsTo('App\Models\Topic');
    }
}
