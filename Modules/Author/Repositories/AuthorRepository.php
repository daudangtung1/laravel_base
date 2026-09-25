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

    /**
     * Get paginated authors with their types eager loaded.
     */
    public function getPaginatedWithTypes(int $perPage = 15)
    {
        return $this->getQueryBuilder()
            ->with('authorTypes')
            ->orderBy('full_name')
            ->paginate($perPage);
    }
}
