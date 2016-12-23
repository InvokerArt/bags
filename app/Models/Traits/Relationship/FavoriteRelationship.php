<?php

namespace App\Models\Traits\Relationship;

trait FavoriteRelationship
{
    public function favorite()
    {
        return $this->morphTo();
    }
}
