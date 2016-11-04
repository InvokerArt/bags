<?php

namespace App\Policies;

use App\Models\Demands\Demand;
use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DemandPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the demand.
     *
     * @param  \App\User  $user
     * @param  \App\Demand  $demand
     * @return mixed
     */
    public function update(User $user, Demand $demand)
    {
        return $user->id === $demand->user_id;
    }

    /**
     * Determine whether the user can delete the demand.
     *
     * @param  \App\User  $user
     * @param  \App\Demand  $demand
     * @return mixed
     */
    public function delete(User $user, Demand $demand)
    {
        return $user->id === $demand->user_id;
    }
}
