<?php

namespace App\Models\Topics;

use Illuminate\Database\Eloquent\Model;
use App\Models\Topics\Traits\Relationship\VoteRelationship;

class Vote extends Model
{
    use VoteRelationship;
    
    protected $fillable = ['user_id', 'votable_id', 'votable_type', 'is'];
}
