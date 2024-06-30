<?php

namespace Usermp\LaravelPermission\Models;

use App\Models\User;
use \Usermp\LaravelPermission\Models\Role;
use \Usermp\LaravelPermission\Models\Permission;

class ExtendedUser extends User
{
    /**
     * Get the roles associated with the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get the permissions associated with the user.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Check if the user has a specific permission.
     */
    public function hasPermission($permission)
    {
        if ($this->permissions->contains('name', $permission)) {
            return true;
        }

        foreach ($this->roles as $role) {
            if ($role->permissions->contains('name', $permission)) {
                return true;
            }
        }

        return false;
    }
}
