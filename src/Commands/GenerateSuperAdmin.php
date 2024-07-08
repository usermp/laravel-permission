<?php

namespace Usermp\LaravelPermission\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
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
        // $permission   = Permission::create(["name" => "Super Admin"]);
        // $routes       = Route::getRoutes();

        // foreach ($routes as $route) {
        //     $name = $route->getName();
        //     if ($name) {
        //         $this->permissionService->createCrudRoles($name ,true);
        //         $this->info("Created role: $name");
        //     }
        // }
    }
}
