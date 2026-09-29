<?php

namespace Modules\Author\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Author\Http\Resources\AuthorResource;
use Modules\Author\Services\AuthorApiService;

/**
 * Public author endpoints — phục vụ trang danh sách / chi tiết tác giả
 * ở frontend. Không cần token.
 *
 * GET /api/authors
 * GET /api/authors/{author}   (author = username)
 */
class AuthorProfileController extends Controller
{
    /**
     * Số bản ghi tối đa cho mỗi trang.
     */
    const MAX_PER_PAGE = 50;

    protected AuthorApiService $authorApiService;

    public function __construct(AuthorApiService $authorApiService)
    {
        $this->authorApiService = $authorApiService;
    }

    /**
     * GET /api/authors
     *
     * Danh sách tác giả công khai (kèm types + số bài viết).
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $this->resolvePerPage($request);

        $authors = $this->authorApiService->getPublicList($perPage);

        return response()->json([
            'data' => AuthorResource::collection($authors)->resolve($request),
            'meta' => [
                'current_page' => $authors->currentPage(),
                'per_page'     => $authors->perPage(),
                'total'        => $authors->total(),
                'last_page'    => $authors->lastPage(),
            ],
        ]);
    }

    /**
     * GET /api/authors/{author}
     *
     * Chi tiết tác giả + danh sách bài viết đã publish (phân trang).
     */
    public function show(Request $request, string $author): JsonResponse
    {
        $profile = $this->authorApiService->getPublicProfile($author);

        abort_unless($profile, 404, 'Không tìm thấy tác giả.');

        $posts = $this->authorApiService->getPublicPosts(
            $profile,
            $this->resolvePerPage($request)
        );

        return response()->json([
            'data'  => AuthorResource::make($profile)->resolve($request),
            'posts' => [
                'data' => $posts->items(),
                'meta' => [
                    'current_page' => $posts->currentPage(),
                    'per_page'     => $posts->perPage(),
                    'total'        => $posts->total(),
                    'last_page'    => $posts->lastPage(),
                ],
            ],
        ]);
    }

    /**
     * Đọc per_page từ query string, giới hạn trong khoảng 1..MAX_PER_PAGE.
     */
    protected function resolvePerPage(Request $request): int
    {
        $perPage = (int) $request->input('per_page', 12);

        return max(1, min($perPage, self::MAX_PER_PAGE));
    }
}
