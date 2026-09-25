<?php

namespace Modules\Author\Services;

use Modules\Author\Entities\AuthorType;
use Modules\Author\Repositories\AuthorTypeRepository;

class AuthorTypeService
{
    protected AuthorTypeRepository $authorTypeRepository;

    public function __construct(AuthorTypeRepository $authorTypeRepository)
    {
        $this->authorTypeRepository = $authorTypeRepository;
    }

    /**
     * Get paginated list of author types.
     */
    public function getPaginated(int $perPage = 15)
    {
        return $this->authorTypeRepository->getPaginated($perPage);
    }

    /**
     * Get active author types for dropdown.
     */
    public function getForSelect()
    {
        return $this->authorTypeRepository->getForSelect();
    }

    /**
     * Find author type by ID.
     */
    public function findById(int $id): AuthorType
    {
        return $this->authorTypeRepository->show($id);
    }

    /**
     * Create a new author type.
     */
    public function create(array $data): AuthorType
    {
        return $this->authorTypeRepository->store($data);
    }

    /**
     * Update an existing author type.
     */
    public function update(int $id, array $data): bool
    {
        return (bool) $this->authorTypeRepository->updateById($data, $id);
    }

    /**
     * Delete an author type.
     */
    public function delete(int $id): bool
    {
        return (bool) $this->authorTypeRepository->delete($id);
    }
}
