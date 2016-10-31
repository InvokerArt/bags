<?php

namespace App\Models\Topics;

use App\Models\Access\User\User;
use App\Models\Topics\Traits\Attribute\TopicAttribute;
use App\Models\Topics\Traits\Relationship\TopicRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use SoftDeletes, TopicRelationship, TopicAttribute;

    public static function topicFilter($query, $request)
    {
        if ($request->has('id')) {
            $query = $query->where('id', $request->get('id'));
        }

        if ($request->has('title')) {
            $query = $query->where('title', 'like', "%{$request->get('title')}%");
        }

        if ($request->has('username')) {
            $query = $query->where('users.username', $request->get('username'));
        }

        if ($request->has('category')) {
            $query = $query->where('categories_topics.id', $request->get('category'));
        }

        if ($request->has('is_excellent')) {
            $query = $query->where('is_excellent', $request->get('is_excellent'));
        }

        if ($request->has('is_blocked')) {
            $query = $query->where('is_blocked', $request->get('is_blocked'));
        }

        return $query;
    }
}
