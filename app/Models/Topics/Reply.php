<?php

namespace App\Models\Topics;

use App\Models\Users\User;
use App\Models\Topics\Traits\Attribute\ReplyAttribute;
use App\Models\Topics\Traits\Relationship\ReplyRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Model
{
    use SoftDeletes, ReplyRelationship, ReplyAttribute;

    public static function replyFilter($query, $request)
    {
        if ($request->has('id')) {
            $query = $query->where('replies.id', $request->get('id'));
        }

        if ($request->has('username')) {
            $query = $query->where('users.username', $request->get('username'));
        }

        if ($request->has('content')) {
            $query = $query->where('replies.content', 'like', "%{$request->get('content')}%");
        }

        if ($request->has('title')) {
            $query = $query->where('topics.title', 'like', "%{$request->get('title')}%");
        }

        return $query;
    }
}
