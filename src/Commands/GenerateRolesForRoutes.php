<?php

namespace Usermp\LaravelPermission\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Usermp\LaravelPermission\Services\PermissionService;

class GenerateRolesForRoutes extends Command
{
    protected $signature = 'generate:roles';
    protected $description = 'Generate roles for all routes';

    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        parent::__construct();
        $this->permissionService = $permissionService;
    }

    public function handle()
    {
        $routes = Route::getRoutes();

        foreach ($routes as $route) {
            $name = $route->getName();
            if ($name) {
                $parts = explode('.', $name);
                if (count($parts) === 2) {
                    $entity = $parts[0];
                    $operation = $parts[1];
                    $roleName = "{$entity}.{$operation}";
                    $this->permissionService->createCrudRoles($entity);
                    $this->info("Created role: $roleName");
                }
            }
        }
    }
}
