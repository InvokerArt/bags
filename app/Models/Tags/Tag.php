<?php

namespace App\Models\Tags;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tags\Traits\Relationship\TagsRelationship;
use App\Models\Tags\Traits\Attribute\TagsAttribute;

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
}
