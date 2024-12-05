<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Modules\Core\View\Components\SecondDemo;

class ComponentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component('second-demo', SecondDemo::class);
    }

    public function register()
    {

    }

    public function provides()
    {
        return [];
    }
}
