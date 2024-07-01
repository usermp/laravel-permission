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
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations');

        // Register middleware
        $this->registerMiddleware();
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
