<?php

namespace App\Models\Jobs\Traits\Relationship;

trait JobRelationship
{
    public function user()
    {
        $this->belongsTo('App\Models\Users\User');
    }

    public function favorites()
    {
        return $this->morphMany('App\Models\Favorites\Favorite', 'favorite');
    }
}
