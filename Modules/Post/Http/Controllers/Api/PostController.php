<?php

namespace Modules\Post\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Post\Entities\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()->published()->with('category:id,name,slug')
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', fn ($category) => $category->where('slug', $request->input('category')));
            })
            ->latest('published_at')->paginate(min($request->integer('per_page', 15), 100));

        return response()->json($posts);
    }

    public function show(Post $post)
    {
        abort_unless($post->isPublished(), 404);
        $post->load('category:id,name,slug');
        return response()->json(['data' => $post]);
    }
}
