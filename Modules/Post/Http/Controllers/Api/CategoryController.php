<?php

namespace Modules\Post\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Modules\Post\Entities\PostCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = PostCategory::query()->where('is_active', true)
            ->withCount(['posts' => fn ($query) => $query->published()])
            ->orderBy('sort_order')->get();

        return response()->json(['data' => $categories]);
    }

    public function show(PostCategory $postCategory)
    {
        abort_unless($postCategory->is_active, 404);
        $postCategory->loadCount(['posts' => fn ($query) => $query->published()]);
        return response()->json(['data' => $postCategory]);
    }
}
