<?php

namespace Modules\Author\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Author\Services\AuthorService;

class AuthorController extends Controller
{
    protected $module = 'author';
    protected $authorService;

    public function __construct(
        AuthorService $authorService
    ) {
        $this->authorService = $authorService;
    }

    public function index(Request $request)
    {
        $authors = $this->authorService->getListByAdmin();
        return view($this->module . '::author.index', compact('authors'));
    }

    public function create()
    {
        return view($this->module . '::author.detail');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $author = $this->authorService->findById($id);
        return view($this->module . '::author.detail', compact('author'));
    }

    public function edit($id)
    {
        return view('author::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
