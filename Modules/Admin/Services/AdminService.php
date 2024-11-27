<?php

namespace Modules\Admin\Services;

use Modules\Admin\Repositories\AdminRepository;
use Illuminate\Support\Facades\Auth;
use App\Trait\ResponseTrait;

class AdminService
{
    use ResponseTrait;

    protected $adminRepository;

    public function __construct(
        AdminRepository $adminRepository
    ) {
        $this->adminRepository = $adminRepository;
    }

    public function findByField($field, $value)
    {
        return $this->adminRepository->findByField($field, $value, ['id', 'email']);
    }

    public function login($input)
    {
        if (!auth()->guard('admin')->attempt($input)) {
            return false;
        }
        return true;
    }
}
