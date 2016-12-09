<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Relationship\VoteRelationship;

class Vote extends Model
{
    use VoteRelationship;
    
    protected $fillable = ['user_id', 'votable_id', 'votable_type', 'is'];
}
