<?php

namespace Modules\Author\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Author\Http\Requests\StoreAuthorTypeRequest;
use Modules\Author\Http\Requests\UpdateAuthorTypeRequest;
use Modules\Author\Services\AuthorTypeService;

class AuthorTypeController extends Controller
{
    protected AuthorTypeService $authorTypeService;

    public function __construct(AuthorTypeService $authorTypeService)
    {
        $this->authorTypeService = $authorTypeService;
    }

    /**
     * Display a listing of author types.
     */
    public function index()
    {
        $authorTypes = $this->authorTypeService->getPaginated(15);

        return view('author::admin.author-types.index', compact('authorTypes'));
    }

    /**
     * Show the form for creating a new author type.
     */
    public function create()
    {
        return view('author::admin.author-types.create');
    }

    /**
     * Store a newly created author type.
     */
    public function store(StoreAuthorTypeRequest $request)
    {
        $data = $request->validated();
        $data['is_active']  = $request->boolean('is_active', true);
        $data['sort_order'] = $request->input('sort_order', 0);

        $this->authorTypeService->create($data);

        return redirect()
            ->route('admin.author-types.index')
            ->with('success', 'Loại tác giả đã được tạo thành công.');
    }

    /**
     * Show the form for editing an author type.
     */
    public function edit(int $id)
    {
        $authorType = $this->authorTypeService->findById($id);

        return view('author::admin.author-types.edit', compact('authorType'));
    }

    /**
     * Update the specified author type.
     */
    public function update(UpdateAuthorTypeRequest $request, int $id)
    {
        $data = $request->validated();
        $data['is_active']  = $request->boolean('is_active', true);
        $data['sort_order'] = $request->input('sort_order', 0);

        $this->authorTypeService->update($id, $data);

        return redirect()
            ->route('admin.author-types.index')
            ->with('success', 'Loại tác giả đã được cập nhật thành công.');
    }

    /**
     * Remove the specified author type.
     */
    public function destroy(int $id)
    {
        $this->authorTypeService->delete($id);

        return redirect()
            ->route('admin.author-types.index')
            ->with('success', 'Loại tác giả đã được xóa thành công.');
    }
}
