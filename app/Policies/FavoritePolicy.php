<?php

namespace App\Policies;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FavoritePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the favorite.
     *
     * @param  \App\User  $user
     * @param  \App\Favorite  $favorite
     * @return mixed
     */
    public function delete(User $user, Favorite $favorite)
    {
        return $user->id === $favorite->user_id;
    }
}
