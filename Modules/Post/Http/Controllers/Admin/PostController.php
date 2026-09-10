<?php

namespace Modules\Post\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Modules\Post\Entities\Post;
use Modules\Post\Entities\PostCategory;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(15);
        return view('post::admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('post::admin.posts.form', ['post' => new Post(), 'categories' => $this->categories()]);
    }

    public function store(Request $request)
    {
        Post::create($this->payload($request));
        return redirect()->route('admin.posts.index')->with('success', 'Đã tạo bài viết.');
    }

    public function edit(Post $post)
    {
        return view('post::admin.posts.form', ['post' => $post, 'categories' => $this->categories()]);
    }

    public function update(Request $request, Post $post)
    {
        $post->update($this->payload($request, $post));
        return redirect()->route('admin.posts.index')->with('success', 'Đã cập nhật bài viết.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Đã xóa bài viết.');
    }

    private function categories()
    {
        return PostCategory::where('is_active', true)->orderBy('sort_order')->get();
    }

    private function payload(Request $request, ?Post $post = null): array
    {
        $data = $request->validate([
            'category_id' => ['nullable', 'exists:post_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'alpha_dash', 'max:255', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => ['nullable', 'string'],
            'content' => ['required', 'string'],
            'featured_image' => ['nullable', 'url', 'max:255'],
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'published_at' => ['nullable', 'date'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
        ]);

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = Carbon::now();
        }

        return $data;
    }
}
