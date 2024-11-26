<?php

namespace Modules\Author\Services;

use Modules\Author\Repositories\AuthorTypeRepository;

class AuthorTypeService
{
    protected $authorTypeRepository;

    public function __construct(
        AuthorTypeRepository $authorTypeRepository
    ) {
        $this->authorTypeRepository = $authorTypeRepository;
    }

    public function getList()
    {
        $columns = [
            'id',
            'name',
        ];
        return $this->authorTypeRepository->getAll($columns);
    }
}
