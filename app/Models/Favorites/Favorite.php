<?php

namespace App\Models\Favorites;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    
    protected $fillable = ['user_id', 'favorite_id', 'favorite_type'];
}
