<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Attribute\FeedbackAttribute;
use App\Models\Traits\Relationship\FeedbackRelationship;

class Feedback extends Model
{
    use FeedbackAttribute, FeedbackRelationship;

    protected $table = 'feedbacks';
}
