<?php

namespace App\Models\Traits\Relationship;

trait UserRelationship
{
    public function news()
    {
        return $this->hasMany('App\Models\News');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\News');
    }

    public function jobs()
    {
        return $this->hasMany('App\Models\Job');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function company()
    {
        return $this->hasOne('App\Models\Company');
    }

    public function detachCompany($company)
    {
        if (is_object($company)) {
            $company = $company->getKey();
        }

        if (is_array($company)) {
            $company = $company['id'];
        }

        $this->company()->detach($company);
    }

    public function votedTopics()
    {
        return $this->morphedByMany('App\Models\Topic', 'votable', 'votes')->withPivot('created_at');
    }

    public function topics()
    {
        return $this->hasMany('App\Models\Topic');
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Reply');
    }

    public function scopeWithOutBanned($query)
    {
        return $query->where('is_banned', '=', 'no');
    }
}
