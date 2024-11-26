<?php

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use Modules\Author\Services\AuthorTypeService;

class AuthorTypeController extends Controller
{
    protected $authorTypeService;

    public function __construct(
        AuthorTypeService $authorTypeService
    ) {
        $this->authorTypeService = $authorTypeService;
    }

    public function index()
    {
        $data = $this->authorTypeService->getList();
        return $this->responseSuccess($data, 'Get data success');
    }
}
