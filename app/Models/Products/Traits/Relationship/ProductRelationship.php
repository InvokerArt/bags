<?php

namespace App\Models\Products\Traits\Relationship;

trait ProductRelationship
{
    //用户一对多反向
    public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Companies\Company', 'user_id', 'user_id');
    }

    public function favorites()
    {
        return $this->morphMany('App\Models\Favorites\Favorite', 'favorite');
    }
}
