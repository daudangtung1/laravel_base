<?php

namespace Modules\Author\Http\Controllers\Api;

use App\Trait\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Author\Http\Requests\Api\AuthorLoginRequest;
use Modules\Author\Http\Requests\Api\UpdateAuthorProfileRequest;
use Modules\Author\Http\Resources\AuthorResource;
use Modules\Author\Services\AuthorApiService;

class AuthorApiController extends Controller
{
    use ResponseTrait;

    protected AuthorApiService $authorApiService;

    public function __construct(AuthorApiService $authorApiService)
    {
        $this->authorApiService = $authorApiService;
    }

    /**
     * POST /api/author/login
     *
     * Authenticate an author and return a Sanctum bearer token.
     */
    public function login(AuthorLoginRequest $request): JsonResponse
    {
        $author = $this->authorApiService->attemptLogin(
            $request->input('email'),
            $request->input('password')
        );

        if (! $author) {
            return response()->json([
                'status'  => false,
                'code'    => 401,
                'message' => 'Email hoặc mật khẩu không chính xác, hoặc tài khoản đã bị vô hiệu hóa.',
                'data'    => null,
            ], 401);
        }

        $deviceName = $request->input('device_name', 'api');
        $token      = $this->authorApiService->issueToken($author, $deviceName);

        return response()->json([
            'status'  => true,
            'code'    => 200,
            'message' => 'Đăng nhập thành công.',
            'data'    => [
                'token'      => $token,
                'token_type' => 'Bearer',
                'author'     => new AuthorResource($author->load('authorTypes')),
            ],
        ], 200);
    }

    /**
     * POST /api/author/logout
     *
     * Revoke the current author's tokens (requires auth:author middleware).
     */
    public function logout(Request $request): JsonResponse
    {
        /** @var \Modules\Author\Entities\Author $author */
        $author = $request->user();

        $this->authorApiService->revokeTokens($author);

        return response()->json([
            'status'  => true,
            'code'    => 200,
            'message' => 'Đăng xuất thành công.',
            'data'    => null,
        ], 200);
    }

    /**
     * GET /api/author/me
     *
     * Return the authenticated author's profile.
     */
    public function me(Request $request): JsonResponse
    {
        /** @var \Modules\Author\Entities\Author $author */
        $author = $request->user();

        $profile = $this->authorApiService->getProfile($author);

        return response()->json([
            'status'  => true,
            'code'    => 200,
            'message' => 'Lấy thông tin thành công.',
            'data'    => new AuthorResource($profile),
        ], 200);
    }

    /**
     * PATCH /api/author/me
     *
     * Update the authenticated author's profile.
     */
    public function update(UpdateAuthorProfileRequest $request): JsonResponse
    {
        /** @var \Modules\Author\Entities\Author $author */
        $author = $request->user();

        $updated = $this->authorApiService->updateProfile(
            $author,
            $request->validated()
        );

        return response()->json([
            'status'  => true,
            'code'    => 200,
            'message' => 'Cập nhật thông tin thành công.',
            'data'    => new AuthorResource($updated),
        ], 200);
    }
}
