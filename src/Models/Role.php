<?php

namespace Usermp\LaravelPermission\Models;

use Illuminate\Database\Eloquent\Model;
use \Usermp\LaravelPermission\Models\Permission;
use App\Models\User;

class Role extends Model
{
    protected $fillable = ['name'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
