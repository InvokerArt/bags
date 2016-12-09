<?php

namespace App\Models\Traits\Relationship;

trait FeedbackRelationship
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
