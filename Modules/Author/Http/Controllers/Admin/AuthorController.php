<?php

namespace Modules\Author\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Author\Http\Requests\StoreAuthorRequest;
use Modules\Author\Http\Requests\UpdateAuthorRequest;
use Modules\Author\Services\AuthorService;

class AuthorController extends Controller
{
    protected AuthorService $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Display a listing of authors.
     */
    public function index()
    {
        $authors = $this->authorService->getPaginated(15);

        return view('author::admin.authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new author.
     */
    public function create()
    {
        $authorTypes = $this->authorService->getAuthorTypes();

        return view('author::admin.authors.create', compact('authorTypes'));
    }

    /**
     * Store a newly created author.
     */
    public function store(StoreAuthorRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', true);

        $this->authorService->create($data);

        return redirect()
            ->route('admin.authors.index')
            ->with('success', 'Tác giả đã được tạo thành công.');
    }

    /**
     * Show the form for editing an author.
     */
    public function edit(int $id)
    {
        $author      = $this->authorService->findById($id);
        $authorTypes = $this->authorService->getAuthorTypes();

        return view('author::admin.authors.edit', compact('author', 'authorTypes'));
    }

    /**
     * Update the specified author.
     */
    public function update(UpdateAuthorRequest $request, int $id)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', true);

        $this->authorService->update($id, $data);

        return redirect()
            ->route('admin.authors.index')
            ->with('success', 'Tác giả đã được cập nhật thành công.');
    }

    /**
     * Soft-delete the specified author.
     */
    public function destroy(int $id)
    {
        $this->authorService->delete($id);

        return redirect()
            ->route('admin.authors.index')
            ->with('success', 'Tác giả đã được xóa thành công.');
    }
}
