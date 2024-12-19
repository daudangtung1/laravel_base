<?php

namespace App\Service;

use Illuminate\Support\Facades\Auth;

class AdminActivityService
{
    public function loginActivity(): void
    {
        $user = $this->getUserLogin();
        $ip = $this->getIp();
        activity()
            ->causedBy($user)
            ->withProperties(['ip' => $ip])
            ->log('Login');
    }

    public function logoutActivity(): void
    {
        $user = $this->getUserLogin();
        $ip = $this->getIp();
        activity()
            ->causedBy($user)
            ->withProperties(['ip' => $ip])
            ->log('Logout');
    }

    private function getUserLogin()
    {
        return Auth::guard('admin')->user();
    }

    private function getIp()
    {
        return request()->ip();
    }
}
