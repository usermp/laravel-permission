<?php

namespace Usermp\LaravelPermission;

use Illuminate\Support\ServiceProvider;
use Usermp\LaravelPermission\Middleware\CheckPermission;

/**
 * Class PermissionServiceProvider
 *
 * @package Usermp\LaravelPermission\Providers
 */
class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register any bindings or singletons here
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish migrations
        $this->publishes([
            __DIR__ . '/../database/migrations/create_permissions_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_permissions_table.php'),
        ], 'migrations');

        // Register middleware
        $this->registerMiddleware();

        $this->commands([
            \Usermp\LaravelPermission\Commands\GenerateRolesForRoutes::class,
        ]);
    }

    /**
     * Register middleware.
     *
     * @return void
     */
    protected function registerMiddleware()
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('check.permission', CheckPermission::class);
    }
}
