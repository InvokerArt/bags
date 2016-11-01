<?php

namespace App\Models\Exhibitions;

use App\Models\Access\User\User;
use App\Models\Exhibitions\Traits\Attribute\ExhibitionAttribute;
use App\Models\Exhibitions\Traits\Relationship\ExhibitionRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Exhibitions\Exhibitions
 */
class Exhibition extends Model
{
    use SoftDeletes, ExhibitionRelationship, ExhibitionAttribute;

    /**
     * 参数黑名单
     * @var array
     */
    protected $guard = [
        'user_id',
    ];

    protected $dates = [
        'published_at'
    ];

    public static function exhibitionsFilter($query, $request)
    {
        if ($request->has('id')) {
            $query = $query->where('id', '=', $request->get('id'));
        }

        if ($request->has('title')) {
            $query = $query->where('title', 'like', "%{$request->get('title')}%");
        }

        if ($request->has('author')) {
            $user = User::where('name', $request->get('author'))->first();
            $user_id = $user ? $user->id : '';
            $query = $query->where('user_id', $user_id);
        }

        if ($request->has('tags')) {
            $query = $query->whereHas('tags', function ($query) use ($request) {
                $query->where('tags.name', $request->get('tags'));
            });
        }

        if ($request->has('published_from') && !$request->has('published_to')) {
            $query = $query->where('published_at', '>=', $request->get('published_from'));
        }

        if (!$request->has('published_from') && $request->has('published_to')) {
            $query = $query->where('published_at', '<=', $request->get('published_to'));
        }

        if ($request->has('published_from') && $request->has('published_to')) {
            $query = $query->whereBetween('published_at', [$request->get('published_from'),$request->get('published_to')]);
        }

        return $query;
    }
}
