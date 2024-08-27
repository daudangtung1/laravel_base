<?php

namespace App\Providers;

use App\Events\RegisterSendMail;
use App\Listeners\RegisterSendMailConfirmation;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        RegisterSendMail::class => [
            RegisterSendMailConfirmation::class,
        ],
    ];

    public function boot()
    {
        //
    }
}
