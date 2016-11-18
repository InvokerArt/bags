<?php

namespace App\Models\Feedbacks;

use Illuminate\Database\Eloquent\Model;
use App\Models\Feedbacks\Traits\Attribute\FeedbackAttribute;
use App\Models\Feedbacks\Traits\Relationship\FeedbackRelationship;

class Feedback extends Model
{
    use FeedbackAttribute, FeedbackRelationship;
}
