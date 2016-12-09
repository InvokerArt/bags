<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Topic;

class TopicPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Topic $topic)
    {
        return $user->id === $topic->user_id;
    }

    public function delete(User $user, Topic $topic)
    {
        return $user->id === $topic->user_id;
    }
}
