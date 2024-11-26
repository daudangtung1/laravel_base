<?php

namespace Modules\Author\Repositories;

use App\Repositories\BaseRepository;
use Modules\Author\Entities\AuthorType;

class AuthorTypeRepository extends BaseRepository
{
    public function getModel()
    {
        return AuthorType::class;
    }
}
