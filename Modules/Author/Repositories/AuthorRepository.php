<?php

namespace Modules\Author\Repositories;

use App\Repositories\BaseRepository;
use Modules\Author\Entities\Author;

class AuthorRepository extends BaseRepository
{
    public function getModel()
    {
        return Author::class;
    }
}
