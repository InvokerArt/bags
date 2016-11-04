<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Reply;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Reply $reply)
    {
        return $reply->user_id === $user->id;
    }
}
