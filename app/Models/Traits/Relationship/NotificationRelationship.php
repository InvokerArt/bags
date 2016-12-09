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
}
