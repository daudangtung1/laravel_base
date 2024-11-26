<?php

namespace Modules\Author\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
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

    public function getLogin()
    {
        return view($this->module . '::login');
    }

    public function postLogin(Request $request)
    {
        $input = $request->only([
            'email',
            'password',
        ]);

        $author = $this->authorService->findByEmail($input['email']);

        if ($author && Hash::check($input['password'], $author->password)) {
            return redirect()->route('author.dashboard');
        } else {
            dd(2);
        }
    }

    public function dashboard()
    {
        return view($this->module . '::dashboard');
    }

    public function create()
    {
        return view('author::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('author::show');
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
