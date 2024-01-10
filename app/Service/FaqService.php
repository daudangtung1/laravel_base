<?php

namespace App\Service;

use App\Repositories\FaqRepository;

class FaqService
{
    protected $faqRepository;

    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function getList()
    {
        return $this->faqRepository->getAll();
    }
}
