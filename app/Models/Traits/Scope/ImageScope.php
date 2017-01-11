<?php

namespace App\Models\Traits\Scope;

use Carbon\Carbon;

trait ImageScope
{
    public function scopeEffective($query)
    {
        return $query->where('published_from', '<=', Carbon::now())->where('published_to', '>=', Carbon::now());
    }
}
