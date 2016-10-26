<?php

namespace App\Models\Supplies\Traits\Relationship;

trait SupplyRelationship
{
    //用户一对多反向
    public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }
}
