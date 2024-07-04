<?php

namespace Usermp\LaravelPermission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
/**
 * Class Permission
 *
 * @package Usermp\LaravelPermission\Models
 */
class Permission extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    /**
     * The dates that should be mutated to instances of Carbon.
     *
     * @var array
     */
    protected $dates =[
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * Define the relationship between Permission and Role.
     *
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }

    /**
     * Define the relationship between Permission and User.
     *
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(ExtendedUser::class, 'permission_user', 'permission_id', 'user_id');
    }
}
