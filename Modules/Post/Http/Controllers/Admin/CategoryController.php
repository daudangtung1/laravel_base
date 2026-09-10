<?php

namespace Modules\Post\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\Post\Entities\PostCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = PostCategory::withCount('posts')->orderBy('sort_order')->paginate(15);
        return view('post::admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('post::admin.categories.form', ['category' => new PostCategory()]);
    }

    public function store(Request $request)
    {
        PostCategory::create($this->validated($request));
        return redirect()->route('admin.post-categories.index')->with('success', 'Đã tạo danh mục.');
    }

    public function edit(PostCategory $postCategory)
    {
        return view('post::admin.categories.form', ['category' => $postCategory]);
    }

    public function update(Request $request, PostCategory $postCategory)
    {
        $postCategory->update($this->validated($request, $postCategory));
        return redirect()->route('admin.post-categories.index')->with('success', 'Đã cập nhật danh mục.');
    }

    public function destroy(PostCategory $postCategory)
    {
        $postCategory->delete();
        return redirect()->route('admin.post-categories.index')->with('success', 'Đã xóa danh mục.');
    }

    private function validated(Request $request, ?PostCategory $category = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'alpha_dash', 'max:255', Rule::unique('post_categories', 'slug')->ignore($category)],
            'description' => ['nullable', 'string'],
            'is_active' => ['required', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
