<?php

namespace App\Models;

use App\Models\Traits\Attribute\ImageAttribute;
use App\Models\Traits\Relationship\ImageRelationship;
use App\Models\Traits\Scope\ImageScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes, ImageScope, ImageAttribute, ImageRelationship;

    protected $table = 'banner_image';

    protected $fillable = ['banner_id', 'title', 'image_url', 'link', 'target', 'description', 'order', 'published_from', 'published_to'];

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
