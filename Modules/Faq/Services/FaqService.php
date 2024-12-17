<?php

namespace Modules\Faq\Services;

use Modules\Faq\Repositories\FaqRepository;

class FaqService
{
    protected $faqRepository;

    public function __construct(
        FaqRepository $faqRepository
    ) {
        $this->faqRepository = $faqRepository;
    }

    public function getList()
    {
        return $this->faqRepository->getList();
    }

    public function store($input)
    {
        return $this->faqRepository->store($input);
    }
}
