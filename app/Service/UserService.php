<?php

namespace App\Service;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getList()
    {
        return $this->userRepository->getAllWithPaginate(['name', 'email'], 2);
    }

    public function getDetail($id)
    {
        return $this->userRepository->find($id);
    }
}
