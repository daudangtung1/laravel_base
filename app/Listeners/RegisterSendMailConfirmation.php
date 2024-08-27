<?php

namespace App\Listeners;

use App\Events\RegisterSendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class RegisterSendMailConfirmation
{
    public function __construct()
    {
        //
    }

    public function handle(RegisterSendMail $event)
    {
        $user = $event->user;
        Log::info($user);
    }
}
