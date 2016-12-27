<?php

namespace App\Models\Traits\Relationship;

trait RoleRelationship
{
    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany(config('auth.providers.users.model'), config('access.role_user_table'), config('access.role_foreign_key'), config('access.user_foreign_key'));
    }

    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(config('access.permission'), config('access.permission_role_table'), config('access.role_foreign_key'), config('access.permission_foreign_key'))
            ->orderBy('display_name', 'asc');
    }
}