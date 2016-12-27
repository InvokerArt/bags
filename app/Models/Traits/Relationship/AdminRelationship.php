<?php

namespace App\Models\Traits\Relationship;

trait AdminRelationship
{

    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(config('access.role'), config('access.role_user_table'), 'user_id', 'role_id');
    }
    
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
