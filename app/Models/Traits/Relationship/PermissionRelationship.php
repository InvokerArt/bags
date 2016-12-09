<?php

namespace App\Models\Traits\Relationship;

trait PermissionRelationship
{
    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(config('entrust.role'), config('entrust.permission_role_table'), config('permission_foreign_key'), config('role_foreign_key'));
    }
}
