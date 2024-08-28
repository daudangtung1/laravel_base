<?php

namespace Modules\Art\Services;

use Modules\Art\Repositories\TagRepository;

class TagService
{
    protected $tagRepository;

    public function __construct(
        TagRepository $tagRepository
    ) {
        $this->tagRepository = $tagRepository;
    }

    public function store($input)
    {
        return $this->tagRepository->store($input);
    }
}
