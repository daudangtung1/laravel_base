<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppMain\Services\UserService;
use App\Http\Requests\User\CreateFormRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        return $this->baseAction(function () use ($input) {
            return $this->userService->index($input);
        });
    }

    public function store(CreateFormRequest $request)
    {
        return $this->baseActionTransaction(function () use ($request) {
            return $this->userService->create($request->all());
        });
    }

    public function show($id)
    {
        return $this->baseActionTransaction(function () use ($id) {
            return $this->userService->show($id);
        });
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
    }
}
