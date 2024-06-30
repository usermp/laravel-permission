<?php

namespace Usermp\LaravelPermission;

use Illuminate\Support\ServiceProvider;
use Usermp\LaravelPermission\Services\PermissionService;

class LaravelPermissionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PermissionService::class, function ($app) {
            return new PermissionService();
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            if (! class_exists('CreatePermissionsTables')) {
                $this->publishes([
                    __DIR__ . '/database/migrations/create_permissions_tables.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_permissions_tables.php'),
                ], 'migrations');
            }
        }
    }
}
