<?php

namespace App\Models\Traits\Relationship;

trait JobRelationship
{
    public function user()
    {
        $this->belongsTo('App\Models\User');
    }

    public function favorites()
    {
        return $this->morphMany('App\Models\Favorite', 'favorite');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'user_id', 'user_id');
    }
}
