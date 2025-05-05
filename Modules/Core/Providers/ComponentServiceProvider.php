<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Modules\Core\View\Components\SecondDemo;
use Modules\Core\View\Components\Button\Submit;
use Modules\Core\View\Components\Inputs\Upload;
use Modules\Core\View\Components\Inputs\Input;

class ComponentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component('second-demo', SecondDemo::class);
        Blade::component('buttons.submit', Submit::class);
        Blade::component('inputs.upload', Upload::class);
        Blade::component('inputs.input', Input::class);
    }

    public function register() {}

    public function provides()
    {
        return [];
    }
}
