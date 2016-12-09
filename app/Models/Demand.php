<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Traits\Attribute\DemandAttribute;
use App\Models\Traits\Relationship\DemandRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Demands\Demands
 */
class Demand extends Model
{
    use SoftDeletes, DemandRelationship, DemandAttribute;

    /**
     * 参数黑名单
     * @var array
     */
    protected $guard = [
        'user_id',
    ];

    public static function demandFilter($query, $request)
    {
        if ($request->has('id')) {
            $query = $query->where('demands.id', $request->get('id'));
        }

        if ($request->has('title')) {
            $query = $query->where('title', 'like', "%{$request->get('title')}%");
        }

        if ($request->has('username')) {
            $query = $query->where('username', 'like', "%{$request->get('username')}%");
        }

        if ($request->has('quantity')) {
            $query = $query->where('quantity', $request->get('quantity'));
        }

        if ($request->has('published_from') && !$request->has('published_to')) {
            $query = $query->where('published_at', '>=', $request->get('published_from'));
        }

        if (!$request->has('created_from') && $request->has('created_to')) {
            $query = $query->where('created_at', '<=', $request->get('created_to'));
        }

        if ($request->has('created_from') && $request->has('created_to')) {
            $query = $query->whereBetween('created_at', [$request->get('created_from'),$request->get('created_to')]);
        }

        return $query;
    }
}
