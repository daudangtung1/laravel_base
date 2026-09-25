<?php

namespace Modules\Author\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class AuthorServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Author';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'author';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        // Repositories
        $this->app->bind(
            \Modules\Author\Repositories\AdminAuthRepository::class,
            \Modules\Author\Repositories\AdminAuthRepository::class
        );
        $this->app->bind(
            \Modules\Author\Repositories\AuthorTypeRepository::class,
            \Modules\Author\Repositories\AuthorTypeRepository::class
        );
        $this->app->bind(
            \Modules\Author\Repositories\AuthorRepository::class,
            \Modules\Author\Repositories\AuthorRepository::class
        );

        // Services
        $this->app->bind(
            \Modules\Author\Services\AdminAuthService::class,
            \Modules\Author\Services\AdminAuthService::class
        );
        $this->app->bind(
            \Modules\Author\Services\AuthorTypeService::class,
            \Modules\Author\Services\AuthorTypeService::class
        );
        $this->app->bind(
            \Modules\Author\Services\AuthorService::class,
            \Modules\Author\Services\AuthorService::class
        );
        $this->app->bind(
            \Modules\Author\Services\AuthorApiService::class,
            \Modules\Author\Services\AuthorApiService::class
        );
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
