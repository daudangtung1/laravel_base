<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Faq\Services\FaqService;

class FaqController extends Controller
{
    protected $faqService;

    public function __construct(
        FaqService $faqService
    ) {
        $this->faqService = $faqService;
    }

    public function index()
    {
        $data = $this->faqService->getList();
        return $this->responseSuccess($data, 'Get faq data success');
    }
}
