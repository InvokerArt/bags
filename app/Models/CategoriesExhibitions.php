<?php

namespace App\Models;

use Baum\Node;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Exhibitions\CategoriesExhibitions
 */
class CategoriesExhibitions extends Node
{
    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'categories_exhibitions';

    protected $fillable = ['id', 'parent_id', 'lft', 'rgt', 'depth', 'name', 'is_active', 'slug', 'description', 'meta_title', 'meta_keyword', 'meta_description'];
    
    public function exhibitions()
    {
        $this->belongsToMany('App\Models\Exhibitions');
    }
}
