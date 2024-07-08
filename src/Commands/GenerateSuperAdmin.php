<?php

namespace Usermp\LaravelPermission\Commands;

use Illuminate\Console\Command;
use Usermp\LaravelPermission\Models\Role;
use Usermp\LaravelPermission\Models\Permission;
use Usermp\LaravelPermission\Services\PermissionService;

class GenerateRolesForRoutes extends Command
{
    protected $signature = 'generate:admin {UserId}';
    protected $description = 'Generate Super admin';

    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        parent::__construct();
        $this->permissionService = $permissionService;
    }

    public function handle()
    {
        $permission = Permission::create(["name" => "Super Admin"]);

        foreach(Role::all() as $role)
        {
            $role->permissions()->attach($permission->id);
        }
    }
}
