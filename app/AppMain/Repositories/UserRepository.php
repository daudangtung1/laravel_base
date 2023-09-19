<?php

namespace App\AppMain\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function getModel()
    {
        return User::class;
    }
}
