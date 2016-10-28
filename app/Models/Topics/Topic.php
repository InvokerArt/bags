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
            $query = $query->where('id', '=', $request->get('id'));
        }

        if ($request->has('title')) {
            $query = $query->where('title', 'like', "%{$request->get('title')}%");
        }

        return $query;
    }
}
