<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function childrens()
    {
        return $this->hasMany('App\Models\Area', 'parent_id', 'code');
    }
}
