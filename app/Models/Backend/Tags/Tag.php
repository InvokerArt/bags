<?php

namespace App\Models\Backend\Tags;

use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Tags\Traits\Relationship\TagsRelationship;
use App\Models\Backend\Tags\Traits\Attribute\TagsAttribute;

class Tag extends Model
{
    use TagsRelationship, TagsAttribute;
    
    protected $fillable = ['name'];
}
