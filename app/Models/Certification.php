<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Attribute\CertificationAttribute;
use App\Models\Traits\Relationship\CertificationRelationship;

class Certification extends Model
{
    use CertificationAttribute, CertificationRelationship;

    public static function certificationFilter($query, $request)
    {
        if ($request->has('id')) {
            $query = $query->where('certifications.id', $request->get('id'));
        }

        if ($request->has('username')) {
            $query = $query->where('username', 'like', "%{$request->get('username')}%");
        }

        if ($request->has('companyname')) {
            $query = $query->where('companies.name', 'like', "%{$request->get('companyname')}%");
        }

        if ($request->has('status')) {
            $query = $query->where('certifications.status', $request->get('status'));
        }

        if ($request->has('created_from') && !$request->has('created_to')) {
            $query = $query->where('certifications.created_at', '>=', $request->get('created_from'));
        }

        if (!$request->has('created_from') && $request->has('created_to')) {
            $query = $query->where('certifications.created_at', '<=', $request->get('created_to'));
        }

        if ($request->has('created_from') && $request->has('created_to')) {
            $query = $query->whereBetween('certifications.created_at', [$request->get('created_from'),$request->get('created_to')]);
        }

        return $query;
    }
}
