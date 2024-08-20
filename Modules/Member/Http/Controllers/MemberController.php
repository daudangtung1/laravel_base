<?php

namespace Modules\Member\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MemberController extends Controller
{
    public function index()
    {
        return view('member::index');
    }

    public function create()
    {
        return view('member::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('member::show');
    }

    public function edit($id)
    {
        return view('member::edit');
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
