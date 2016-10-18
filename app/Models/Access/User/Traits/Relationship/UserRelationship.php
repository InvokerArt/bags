<?php

namespace App\Models\Access\User\Traits\Relationship;

/**
 * Class UserRelationship
 * @package App\Models\Access\User\Traits\Relationship
 */
trait UserRelationship
{
    public function news()
    {
        return $this->hasMany('App\Models\Backend\News\News');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Backend\News\News');
    }
}
