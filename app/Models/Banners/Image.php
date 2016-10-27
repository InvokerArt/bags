<?php

namespace App\Models\Banners;

use App\Models\Banners\Traits\Attribute\ImageAttribute;
use App\Models\Banners\Traits\Relationship\ImageRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes, ImageAttribute, ImageRelationship;

    protected $table = 'banner_image';

    protected $dates = ['published_from', 'published_to'];
   
    public static function imageFilter($query, $request)
    {
        if ($request->has('id')) {
            $query = $query->where('banner_image.id', $request->get('id'));
        }

        if ($request->has('title')) {
            $query = $query->where('banner_image.title', 'like', "%{$request->get('title')}%");
        }

        if ($request->has('banner_id')) {
            $query = $query->where('banner_id', $request->get('banner_id'));
        }

        return $query;
    }
}
