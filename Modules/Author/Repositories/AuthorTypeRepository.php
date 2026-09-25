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

    /**
     * Get paginated list with ordering.
     */
    public function getPaginated(int $perPage = 15)
    {
        return $this->getQueryBuilder()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate($perPage);
    }

    /**
     * Get active author types for select dropdown.
     */
    public function getForSelect()
    {
        return $this->getQueryBuilder()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'name', 'code', 'color_hex']);
    }
}
