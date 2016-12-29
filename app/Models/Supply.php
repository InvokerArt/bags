<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Traits\Attribute\SupplyAttribute;
use App\Models\Traits\Relationship\SupplyRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supply extends Model
{
    use SoftDeletes, SupplyRelationship, SupplyAttribute;

    protected $dates = ['deleted_at'];

    /**
     * 参数白名单
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'slug', 'price', 'unit', 'content', 'images', 'is_excellent'];

    public static function supplyFilter($query, $request)
    {
        if ($request->has('id')) {
            $query = $query->where('supplies.id', $request->get('id'));
        }

        if ($request->has('title')) {
            $query = $query->where('title', 'like', "%{$request->get('title')}%");
        }

        if ($request->has('username')) {
            $query = $query->where('username', 'like', "%{$request->get('username')}%");
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
