<?php

namespace Modules\Author\Services;

use Modules\Author\Entities\Author;
use Modules\Author\Repositories\AuthorRepository;
use Modules\Author\Repositories\AuthorTypeRepository;

class AuthorService
{
    protected AuthorRepository $authorRepository;
    protected AuthorTypeRepository $authorTypeRepository;

    public function __construct(
        AuthorRepository $authorRepository,
        AuthorTypeRepository $authorTypeRepository
    ) {
        $this->authorRepository     = $authorRepository;
        $this->authorTypeRepository = $authorTypeRepository;
    }

    /**
     * Get paginated authors with author types.
     */
    public function getPaginated(int $perPage = 15)
    {
        return $this->authorRepository->getPaginatedWithTypes($perPage);
    }

    /**
     * Get all active author types (for form dropdowns).
     */
    public function getAuthorTypes()
    {
        return $this->authorTypeRepository->getForSelect();
    }

    /**
     * Find author by ID (with types loaded).
     */
    public function findById(int $id): Author
    {
        $author = $this->authorRepository->show($id);
        $author->load('authorTypes');
        return $author;
    }

    /**
     * Create a new author and sync author types.
     */
    public function create(array $data): Author
    {
        $typeIds = $data['author_type_ids'] ?? [];
        unset($data['author_type_ids']);

        /** @var Author $author */
        $author = $this->authorRepository->store($data);
        $author->authorTypes()->sync($typeIds);

        return $author;
    }

    /**
     * Update an existing author and sync author types.
     */
    public function update(int $id, array $data): bool
    {
        $typeIds = $data['author_type_ids'] ?? [];
        unset($data['author_type_ids']);

        $author = $this->authorRepository->show($id);
        $author->authorTypes()->sync($typeIds);

        return (bool) $this->authorRepository->updateById($data, $id);
    }

    /**
     * Soft-delete an author.
     */
    public function delete(int $id): bool
    {
        return (bool) $this->authorRepository->delete($id);
    }
}
