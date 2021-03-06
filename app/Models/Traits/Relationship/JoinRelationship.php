<?php

namespace App\Models\Traits\Relationship;

trait JoinRelationship
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function userCompany()
    {
        return $this->belongsTo('App\Models\Company', 'user_id', 'user_id');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notification');
    }
}
