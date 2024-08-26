<?php

namespace Modules\Art\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Art\Entities\ArtCategory;

class ArtCategoryController extends Controller
{
    public function index()
    {
        dd(12);
    }

    public function store(Request $request)
    {
        $input = $request->only([
            'title',
            'slug',
            'author_id',
            'status',
        ]);

        $create = ArtCategory::create($input);
        return response()->json([
            'status' => true,
            'data' => $create,
        ]);
    }

    public function show($id)
    {
        return view('art::show');
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
