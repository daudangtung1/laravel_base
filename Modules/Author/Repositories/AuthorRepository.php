<?php

namespace Modules\Author\Repositories;

use App\Repositories\BaseRepository;
use Modules\Author\Entities\Author;

class AuthorRepository extends BaseRepository
{
    public function getModel()
    {
        return Author::class;
    }

    /**
     * Get paginated authors with their types eager loaded.
     */
    public function getPaginatedWithTypes(int $perPage = 15)
    {
        return $this->getQueryBuilder()
            ->with('authorTypes')
            ->orderBy('full_name')
            ->paginate($perPage);
    }

    /*---------------------------------------------------------------------------
    | Public queries (dùng cho trang chi tiết tác giả ở frontend)
    |---------------------------------------------------------------------------*/

    /**
     * Query tác giả hiển thị công khai kèm types và số bài đã publish.
     */
    public function getPublicQueryBuilder()
    {
        return $this->getQueryBuilder()
            ->published()
            ->with(['authorTypes' => fn ($query) => $query->active()->ordered()])
            ->withCount(['posts' => fn ($query) => $query->published()]);
    }

    /**
     * Danh sách tác giả công khai, mới nhất lên đầu.
     */
    public function paginatePublic(int $perPage = 12)
    {
        return $this->getPublicQueryBuilder()
            ->orderByDesc('published_at')
            ->orderBy('full_name')
            ->paginate($perPage);
    }

    /**
     * Tìm tác giả công khai theo username, trả về null nếu không có.
     */
    public function findPublicByUsername(string $username): ?Author
    {
        return $this->getPublicQueryBuilder()
            ->where('username', $username)
            ->first();
    }
}
