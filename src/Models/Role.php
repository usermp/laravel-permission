<?php

namespace Usermp\LaravelPermission\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @package Usermp\LaravelPermission\Models
 */
class Role extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name'];
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Define the relationship between Role and Permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
}
