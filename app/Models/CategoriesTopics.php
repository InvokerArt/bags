<?php

namespace App\Models;

use Baum\Node;

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
        $this->belongsToMany('App\Models\Topic');
    }
}
