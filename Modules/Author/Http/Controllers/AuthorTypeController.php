<?php

namespace Modules\Author\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthorTypeController extends Controller
{
    public function index()
    {
        return view('author::index');
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
