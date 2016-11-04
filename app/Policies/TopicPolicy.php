<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Users\User;
use App\Models\Topics\Topic;

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
