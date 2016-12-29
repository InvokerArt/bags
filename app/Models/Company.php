<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Attribute\CompanyAttribute;
use App\Models\Traits\Relationship\CompanyRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes, CompanyRelationship, CompanyAttribute;

    protected $fillable = ['user_id', 'name', 'telephone', 'address', 'addressDetail', 'notes', 'content', 'licenses', 'photos', 'role'];

    protected $dates = ['deleted_at'];

    public static function companyFilter($query, $request)
    {
        if ($request->has('id')) {
            $query = $query->where('id', $request->get('id'));
        }

        if ($request->has('name')) {
            $query = $query->where('name', 'like', "%{$request->get('name')}%");
        }

        if ($request->has('role')) {
            $query = $query->where('role', $request->get('role'));
        }

        if ($request->has('created_from') && !$request->has('created_to')) {
            $query = $query->where('created_at', '>=', $request->get('created_from'));
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
