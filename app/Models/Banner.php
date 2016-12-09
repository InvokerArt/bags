<?php

namespace App\Models\Banners;

use App\Models\Traits\Attribute\BannerAttribute;
use App\Models\Traits\Relationship\BannerRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use SoftDeletes, BannerAttribute, BannerRelationship;

    protected $dates = ['published_at'];

    public static function bannerFilter($query, $request)
    {
        if ($request->has('id')) {
            $query = $query->where('id', $request->get('id'));
        }

        if ($request->has('title')) {
            $query = $query->where('title', 'like', "%{$request->get('title')}%");
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
