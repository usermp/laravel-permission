<?php

namespace Usermp\LaravelPermission;

use Illuminate\Support\ServiceProvider;
use Usermp\LaravelPermission\Middleware\CheckPermission;

/**
 * Class PermissionServiceProvider
 *
 * @package Usermp\LaravelPermission\Providers
 *
 * Service provider for managing permissions in a Laravel application.
 */
class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * This method is used to bind classes or services into the service container.
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
     * This method is used to bootstrap any application services, such as
     * publishing resources, registering middleware, or executing custom commands.
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

        // Register artisan commands
        $this->commands([
            \Usermp\LaravelPermission\Commands\GenerateRolesForRoutes::class,
        ]);
    }

    /**
     * Register middleware.
     *
     * This method is used to register middleware with the application's router.
     *
     * @return void
     */
    protected function registerMiddleware()
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('check.permission', CheckPermission::class);
    }
}
