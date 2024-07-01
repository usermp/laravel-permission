<?php

namespace Usermp\LaravelPermission\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Usermp\LaravelPermission\Models\Permission;

/**
 * Class ExtendedUser
 *
 * @package Usermp\LaravelPermission\Models
 */
class ExtendedUser extends Authenticatable
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Check if the user has permission to access a specific route.
     *
     * @param  string  $routeName
     * @return bool
     */
    public function hasPermissionToRoute($routeName)
    {
        // Get the user's permissions
        $permission = $this->permissions()->first();

        if (!$permission) {
            return false;
        }

        // Check if the permission's roles include the route
        $hasAccess = $permission->roles()->where('name', $routeName)->exists();

        return $hasAccess;
    }

    /**
     * Define the relationship between User and Permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user', 'user_id', 'permission_id');
    }
}
