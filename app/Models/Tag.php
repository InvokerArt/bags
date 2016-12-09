<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Relationship\TagsRelationship;
use App\Models\Traits\Attribute\TagsAttribute;

/**
 * App\Models/Tags\Tag
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $checkbox_button
 * @property-read mixed $action_buttons
 * @method static \Illuminate\Database\Query\Builder|\App\Models/Tags\Tag whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models/Tags\Tag whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models/Tags\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models/Tags\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    use TagsRelationship, TagsAttribute;
    
    protected $fillable = ['name'];

    public static function tagFilter($query, $request)
    {
        if ($request->has('id')) {
            $query->where('id', '=', $request->get('id'));
        }

        if ($request->has('name')) {
            $query->where('name', 'like', "%{$request->get('name')}%");
        }

        if ($request->has('created_from') && !$request->has('created_to')) {
            $query->where('created_at', '>=', $request->get('created_from'));
        }

        if (!$request->has('created_from') && $request->has('created_to')) {
            $query->where('created_at', '<=', $request->get('created_to'));
        }

        if ($request->has('created_from') && $request->has('created_to')) {
            $query->whereBetween('created_at', [$request->get('created_from'),$request->get('created_to')]);
        }
    }
}
