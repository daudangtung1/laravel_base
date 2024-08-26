<?php

namespace Modules\Art\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Art\Entities\Art;
use Intervention\Image\Image;

class ArtController extends Controller
{
    public function index()
    {
        dd(1);
    }

    public function store(Request $request)
    {
        $input = $request->only([
            'title',
            'slug',
            'art_category_id',
            'status',
            'file',
        ]);

        $path = uploadImage($input['file'], $input['art_category_id']);
        $pathFile = storage_path('app\\' . $path);

        return response()->json([
            'status' => true,
            'data' =>null,
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
