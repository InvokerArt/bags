<?php

namespace App\Models\Topics;

use Baum\Node;
use Illuminate\Database\Eloquent\Model;

class CategoriesTopics extends Node
{
    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'categories_topics';
    
    public function topics()
    {
        $this->belongsToMany('App\Models\Topics\Topic');
    }
}
