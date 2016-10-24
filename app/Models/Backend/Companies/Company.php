<?php

namespace App\Models\Backend\Companies;

use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Companies\Traits\Attribute\CompanyAttribute;
use App\Models\Backend\Companies\Traits\Relationship\CompanyRelationship;

class Company extends Model
{
    use CompanyRelationship, CompanyAttribute;
    protected $fillable = [
        'user_id',
        'name',
        'telephone',
        'address',
        'notes',
        'content',
        'licenses',
        'photos',
        'role',
    ];
}
