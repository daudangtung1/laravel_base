<?php

namespace App\Service;

use App\Repositories\ContactRepository;

class ContactService
{
    protected $contactRepository;

    public function __construct(
        ContactRepository $contactRepository
    ) {
        $this->contactRepository = $contactRepository;
    }

    public function store($input)
    {
        return $this->contactRepository->store($input);
    }
}
