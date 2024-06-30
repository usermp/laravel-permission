<?php

namespace Usermp\LaravelPermission\Models;

use Illuminate\Database\Eloquent\Model;
use \Usermp\LaravelPermission\Models\Role;
use App\Models\User;

class Permission extends Model
{
    protected $fillable = ['name'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
