<?php

namespace App\Models\Notifications\Traits\Relationship;

trait NotificationRelationship
{
    public function notificationUser()
    {
        return $this->hasOne('App\Models\Notifications\NotificationUser');
    }
    
    public function notification()
    {
        return $this->morphTo();
    }
}
