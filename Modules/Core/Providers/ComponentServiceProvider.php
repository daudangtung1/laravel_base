<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Modules\Core\View\Components\SecondDemo;
use Modules\Core\View\Components\Button\Submit;

class ComponentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component('second-demo', SecondDemo::class);
        Blade::component('buttons.submit', Submit::class);
    }

    public function register() {}

    public function provides()
    {
        return [];
    }
}
