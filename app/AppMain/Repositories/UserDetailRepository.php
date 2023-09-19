<?php

namespace App\AppMain\Repositories;

use App\Models\UserDetail;

class UserDetailRepository extends BaseRepository
{
    public function getModel()
    {
        return UserDetail::class;
    }
}
