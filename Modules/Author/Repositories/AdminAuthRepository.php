<?php

namespace Modules\Author\Repositories;

use App\Repositories\BaseRepository;
use Modules\Admin\Entities\Admin;

class AdminAuthRepository extends BaseRepository
{
    public function getModel()
    {
        return Admin::class;
    }

    /**
     * Find an admin user by email.
     */
    public function findByEmail(string $email): ?Admin
    {
        return $this->getQueryBuilder()
            ->where('email', $email)
            ->first();
    }
}
