<?php

namespace Modules\Admin\Repositories;

use App\Repositories\BaseRepository;
use Modules\Admin\Entities\Admin;

class AdminAuthRepository extends BaseRepository
{
    public function getModel()
    {
        return Admin::class;
    }

    /**
     * Find an admin user by email address.
     */
    public function findByEmail(string $email): ?Admin
    {
        return $this->getQueryBuilder()
            ->where('email', $email)
            ->first();
    }
}
