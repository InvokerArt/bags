<?php

namespace App\Models\Backend\Favorites;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Backend\Favorites\Favorite
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $favorite_id
 * @property string $favorite_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\Favorites\Favorite whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\Favorites\Favorite whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\Favorites\Favorite whereFavoriteId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\Favorites\Favorite whereFavoriteType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\Favorites\Favorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\Favorites\Favorite whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Favorite extends Model
{
    //
}
