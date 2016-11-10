<?php

namespace App\Models\Notifications\Traits\Relationship;

trait NotificationUserRelationship
{
    public function notification()
    {
        return $this->belongsTo('App\Models\Notifications\Notification');
    }
}
