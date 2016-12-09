<?php

namespace App\Models\Traits\Relationship;

trait AdminRelationship
{
    public function news()
    {
        return $this->hasMany('App\Models\News');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\News');
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
}
