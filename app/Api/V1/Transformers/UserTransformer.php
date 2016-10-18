<?php

namespace App\Api\V1\Transformers;

use App\Models\Access\User\User;
use Illuminate\Http\Request;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'mobile' => $user->mobile,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'created_at' => (string)$user->created_at,
        ];
    }
}
