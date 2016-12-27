<?php

namespace App\Models\Traits\Relationship;

trait PermissionRelationship
{
    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(config('access.role'), config('access.permission_role_table'), config('permission_foreign_key'), config('role_foreign_key'));
    }
}
