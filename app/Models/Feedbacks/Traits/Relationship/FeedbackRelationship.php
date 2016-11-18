<?php

namespace App\Models\Feedbacks\Traits\Relationship;

trait FeedbackRelationship
{
    public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }
}
