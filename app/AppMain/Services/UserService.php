<?php

namespace App\AppMain\Services;

use App\AppMain\Repositories\UserRepository;
use App\AppMain\Config\AppConst;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index($input)
    {
        $data = $this->userRepository->allWithOne('userDetail');
        $limit = $input['limit'] ?? AppConst::PAGE_LIMIT;
        if (isset($input['page']) && !blank($input['page'])) {
            return collect($data)->paginate($limit, null, session()->get('page'));
        }
        return collect($data);
    }

    public function create($input)
    {
        $user = [
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
        ];
        $user = $this->userRepository->create($user);

        return $user;
    }

    public function show($id)
    {
        return $this->userRepository->find($id);
    }
}
