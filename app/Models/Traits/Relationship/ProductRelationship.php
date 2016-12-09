<?php

namespace App\Models\Traits\Relationship;

trait ProductRelationship
{
    //用户一对多反向
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'user_id', 'user_id');
    }

    public function favorites()
    {
        return $this->morphMany('App\Models\Favorite', 'favorite');
    }
}
