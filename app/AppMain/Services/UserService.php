<?php

namespace App\AppMain\Services;

use App\AppMain\Repositories\UserRepository;
use App\AppMain\Repositories\UserDetailRepository;
use App\AppMain\Config\AppConst;
use App\Observers\UserObserver;

class UserService
{
    protected $userRepository, $userDetailRepository;

    public function __construct(UserRepository $userRepository, UserDetailRepository $userDetailRepository)
    {
        $this->userRepository = $userRepository;
        $this->userDetailRepository = $userDetailRepository;
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
        if ($user);
        $user_detail = [
            'user_name' => $input['user_name'],
            'user_id' => $user->id,
        ];
        $user_detail = $this->userDetailRepository->create($user_detail);

        if ($user && $user_detail) {
            $model = $this->userRepository->getModel();
            $model::observe(UserObserver::class , ':writeLog');
            return true;
        }
        return false;
    }

    public function show($id)
    {
        return $this->userRepository->find($id);
    }
}
