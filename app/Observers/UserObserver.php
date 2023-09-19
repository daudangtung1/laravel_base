<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    public function created(User $user)
    {
        Log::info('User created: ' . $user->toJson());
    }

    public function writeLog($user)
    {
        Log::info('User created: ' . $user->toJson());
    }
}
