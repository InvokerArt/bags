<?php

namespace App\Models\Traits\Relationship;

trait CertificationRelationship
{
    public function scopeValidate($query)
    {
        return $query->where('status', 2);
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
}
