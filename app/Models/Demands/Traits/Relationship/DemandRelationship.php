<?php

namespace App\Models\Demands\Traits\Relationship;

trait DemandRelationship
{
    //用户一对多反向
    public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

    public function favorites()
    {
        return $this->morphMany('App\Models\Favorites\Favorite', 'favorite');
    }
}
