<?php

namespace App\Models\Traits\Relationship;

trait NotificationUserRelationship
{
    public function notification()
    {
        return $this->belongsTo('App\Models\Notification');
    }
}
