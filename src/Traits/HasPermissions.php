<?php

namespace Usermp\LaravelPermission\Traits;

use Usermp\LaravelPermission\Models\Permission;

/**
 * Trait HasPermissions
 *
 * @package Usermp\LaravelPermission\Traits
 */
trait HasPermissions
{
    /**
     * Define the relationship between User and Permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    /**
     * Define the relationship between User and Role through Permission.
     *
     * @return mixed
     */
    public function roles()
    {
        return $this->permission->roles();
    }

    /**
     * Check if the user has a specific role.
     *
     * @param  string  $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->roles->contains('name', $role);
    }

    /**
     * Assign a permission to the user.
     *
     * @param  string  $permission
     * @return void
     */
    public function assignPermission($permission)
    {
        $permission = Permission::where('name', $permission)->first();
        if ($permission) {
            $this->permission()->associate($permission);
            $this->save();
        }
    }
}
