<?php

namespace App\Models\Favorites;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Favorites\Favorite
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $favorite_id
 * @property string $favorite_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Favorites\Favorite whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Favorites\Favorite whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Favorites\Favorite whereFavoriteId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Favorites\Favorite whereFavoriteType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Favorites\Favorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Favorites\Favorite whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Favorite extends Model
{
    //
}
