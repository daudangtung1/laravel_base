<?php

namespace Modules\Author\Services;

use Modules\Author\Repositories\AuthorRepository;

class AuthorService
{
    protected $authorRepository;

    public function __construct(
        AuthorRepository $authorRepository
    ) {
        $this->authorRepository = $authorRepository;
    }

    public function getListByAdmin()
    {
        return $this->authorRepository->getListByAdmin();
    }

    public function findByEmail($email)
    {
        return $this->authorRepository->findByField('email', $email);
    }

    public function findById($id)
    {
        return $this->authorRepository->find($id);
    }

    public function store($input)
    {
        return $this->authorRepository->store($input);
    }
}
