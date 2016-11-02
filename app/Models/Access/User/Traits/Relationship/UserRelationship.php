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
        return $this->hasMany('App\Models\News\News');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\News\News');
    }

    public function company()
    {
        return $this->hasOne('App\Models\Companies\Company');
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
}
