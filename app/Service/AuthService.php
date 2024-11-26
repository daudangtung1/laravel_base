<?php

namespace App\Service;

use App\Trait\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Service\UserService;

class AuthService
{
    use ResponseTrait;

    protected $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

    public function login($user)
    {
        if (!Auth::attempt($user)) {
            return $this->responseFail('Email or password incorrect.');
        }

        $currentUser = $this->userService->findByField('email', $user['email']);
        $tokenResult = $currentUser->createToken('authToken')->plainTextToken;

        $user['token'] = $tokenResult;
        unset($user['password']);
        return $this->responseSuccess($user, 'Login success');
    }

    public function logout()
    {

    }
}
