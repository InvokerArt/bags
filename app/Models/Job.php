<?php

namespace App\Models;

use App\Models\Traits\Attribute\JobAttribute;
use App\Models\Traits\Relationship\JobRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes, JobAttribute, JobRelationship;

    protected $dates = ['published_at'];

    public static function jobFilter($query, $request)
    {
        if ($request->has('id')) {
            $query = $query->where('jobs.id', $request->get('id'));
        }

        if ($request->has('username')) {
            $query = $query->where('username', 'like', "%{$request->get('username')}%");
        }

        if ($request->has('created_from') && !$request->has('created_to')) {
            $query = $query->where('jobs.created_at', '>=', $request->get('created_from'));
        }

        if (!$request->has('created_from') && $request->has('created_to')) {
            $query = $query->where('jobs.created_at', '<=', $request->get('created_to'));
        }

        if ($request->has('created_from') && $request->has('created_to')) {
            $query = $query->whereBetween('jobs.created_at', [$request->get('created_from'),$request->get('created_to')]);
        }

        return $query;
    }
}
