<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\UserObserver;
use App\Models\User;

class ObserverServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        User::observe(UserObserver::class);
    }
}
