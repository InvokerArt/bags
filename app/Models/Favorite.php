<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Relationship\FavoriteRelationship;

class Favorite extends Model
{
    use FavoriteRelationship;
    protected $fillable = ['user_id', 'favorite_id', 'favorite_type'];
}
