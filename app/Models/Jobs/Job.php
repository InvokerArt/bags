<?php

namespace App\Models\Jobs;

use App\Models\Jobs\Traits\Attribute\JobAttribute;
use App\Models\Jobs\Traits\Relationship\JobRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes, JobAttribute, JobRelationship;

    protected $dates = ['published_at'];
}
