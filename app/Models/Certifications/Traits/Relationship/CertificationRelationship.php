<?php

namespace App\Models\Certifications\Traits\Relationship;

trait CertificationRelationship
{
    public function scopeValidate($query)
    {
        return $query->where('status', 2);
    }
}
