<?php

namespace App\Policies;

use App\Models\Supplies\Supply;
use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupplyPolicy
{
    use HandlesAuthorization;
    public function update(User $user, Supply $supply)
    {
        return $user->id === $supply->user_id;
    }

    /**
     * Determine whether the user can delete the supply.
     *
     * @param  \App\User  $user
     * @param  \App\Supply  $supply
     * @return mixed
     */
    public function delete(User $user, Supply $supply)
    {
        return $user->id === $supply->user_id;
    }
}
