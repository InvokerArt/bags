<?php

namespace App\Models;

use Baum\Node;
use Illuminate\Database\Eloquent\Model;

class CategoriesNews extends Node
{
    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'categories_news';
    
    public function news()
    {
        $this->belongsToMany('App\Models\News');
    }
}
