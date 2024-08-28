<?php

namespace Modules\Art\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Art\Services\TagService;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(
        TagService $tagService
    ) {
        $this->tagService = $tagService;
    }

    public function index()
    {
        return view('art::index');
    }

    public function store(Request $request)
    {
        $input = $request->only([
            'title',
            'slug',
        ]);

        $create = $this->tagService->store($input);
        return response()->json([
            'status' => true,
            'data' => $create,
        ]);
    }

    public function show($id) {}

    public function update(Request $request, $id)
    {
        $input = $request->only([
            'title',
            'slug',
        ]);
    }

    public function destroy($id) {}
}
