<?php

namespace App\Models\Joins\Traits\Relationship;

trait JoinRelationship
{
    public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Companies\Company');
    }
}
