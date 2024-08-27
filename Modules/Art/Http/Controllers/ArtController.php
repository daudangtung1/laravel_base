<?php

namespace Modules\Art\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Art\Entities\Art;

class ArtController extends Controller
{
    public function index()
    {
        $data = Art::all();
        foreach ($data as $v) {
            $v->path = getImageUrl($v->path);
        }
        return view('art::art.index', compact('data'));
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
        $pathFile = public_path($path);
        $dimension = getUploadImageSize($pathFile);
        $size = formatBytes(filesize($pathFile));

        if (!blank($dimension)) {
            $property = $dimension['width'] . 'x' . $dimension['height'] . 'x' . $size;
        } else {
            $property = $size;
        }
        unset($input['file']);
        $input['size'] = $property;
        $input['path'] = $path;
        $create = Art::create($input);

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
