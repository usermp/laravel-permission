<?php

namespace Usermp\LaravelPermission\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 *
 * @package Usermp\LaravelPermission\Models
 */
class Permission extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * Define the relationship between Permission and Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }

    /**
     * Define the relationship between Permission and User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(ExtendedUser::class, 'permission_user', 'permission_id', 'user_id');
    }
}
