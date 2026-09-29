<?php

namespace Modules\Author\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Author\Entities\Author;
use Modules\Author\Entities\AuthorType;

/**
 * Seed dữ liệu tác giả: loại tác giả + tài khoản tác giả.
 * Chạy: php artisan db:seed --class="Modules\Author\Database\Seeders\AuthorTableSeeder"
 */
class AuthorTableSeeder extends Seeder
{
    public function run()
    {
        $types = $this->seedAuthorTypes();
        $authors = $this->seedAuthors();

        $this->normalizeLegacyUsernames();

        $this->syncAuthorTypes($authors, $types);
    }

    /**
     * Loại tác giả (Artist / Photographer / Writer...)
     */
    protected function seedAuthorTypes(): array
    {
        $data = [
            [
                'name'        => 'Họa sĩ',
                'code'        => 'artist',
                'description' => 'Tác giả sáng tác tranh',
                'color_hex'   => '#f97316',
                'sort_order'  => 1,
            ],
            [
                'name'        => 'Nhiếp ảnh gia',
                'code'        => 'photographer',
                'description' => 'Tác giả nhiếp ảnh',
                'color_hex'   => '#0ea5e9',
                'sort_order'  => 2,
            ],
            [
                'name'        => 'Nhà báo',
                'code'        => 'journalist',
                'description' => 'Tác giả viết bài, phóng sự',
                'color_hex'   => '#8b5cf6',
                'sort_order'  => 3,
            ],
        ];

        $types = [];
        foreach ($data as $row) {
            $types[$row['code']] = AuthorType::updateOrCreate(
                ['code' => $row['code']],
                $row + ['is_active' => true]
            );
        }

        return $types;
    }

    /**
     * Tài khoản tác giả (username dùng làm slug trên URL).
     */
    protected function seedAuthors(): array
    {
        $data = [
            [
                'username'     => 'nguyen-van-minh',
                'full_name'    => 'Nguyễn Văn Minh',
                'email'        => 'minh.nguyen@art.vn',
                'bio'          => 'Họa sĩ hiện đại, tác giả của hơn 30 tác phẩm tranh dầu trưng bày tại nhiều bảo tàng trong nước. Sáng tác của anh lấy cảm hứng từ cảnh vật miền Bắc và ký ức về quê hương.',
                'avatar'       => 'https://i.pravatar.cc/300?img=12',
                'website_url'  => 'https://nguyenvanminh.art',
                'location'     => 'Hà Nội, Việt Nam',
                'is_active'    => true,
                'published_at' => now()->subMonths(8),
            ],
            [
                'username'     => 'hoang-thi-lan',
                'full_name'    => 'Hoàng Thị Lan',
                'email'        => 'lan.hoang@art.vn',
                'bio'          => 'Nhiếp ảnh gia chuyên về ảnh chân dung và đời sống đô thị. Từng đoạt giải thưởng tại các cuộc thi nhiếp ảnh quốc tế.',
                'avatar'       => 'https://i.pravatar.cc/300?img=32',
                'website_url'  => 'https://lanhoang.photo',
                'location'     => 'TP. Hồ Chí Minh, Việt Nam',
                'is_active'    => true,
                'published_at' => now()->subMonths(5),
            ],
            [
                'username'     => 'pham-quoc-bao',
                'full_name'    => 'Phạm Quốc Bảo',
                'email'        => 'bao.pham@art.vn',
                'bio'          => 'Nhà báo văn hóa, viết về nghệ thuật và di sản. Đồng thời là người sáng lập bản tin nghệ thuật địa phương.',
                'avatar'       => 'https://i.pravatar.cc/300?img=51',
                'website_url'  => null,
                'location'     => 'Đà Nẵng, Việt Nam',
                'is_active'    => true,
                'published_at' => now()->subMonths(2),
            ],
        ];

        $authors = [];
        foreach ($data as $row) {
            $authors[$row['username']] = Author::updateOrCreate(
                ['username' => $row['username']],
                $row + ['password' => bcrypt('123456')]
            );
        }

        return $authors;
    }

    /**
     * Chuẩn hóa username cũ (ví dụ "Test author" -> "test-author")
     * để làm route key trên URL.
     */
    protected function normalizeLegacyUsernames(): void
    {
        Author::query()->get()->each(function (Author $author) {
            $slug = Str::slug($author->username);

            if ($slug === $author->username || $slug === '') {
                return;
            }

            if (Author::query()->where('username', $slug)->exists()) {
                return;
            }

            $author->update(['username' => $slug]);
        });
    }

    /**
     * Gán loại tác giả cho từng tài khoản.
     */
    protected function syncAuthorTypes(array $authors, array $types): void
    {
        $map = [
            'nguyen-van-minh'  => ['artist'],
            'hoang-thi-lan'    => ['photographer', 'journalist'],
            'pham-quoc-bao'    => ['journalist'],
        ];

        foreach ($authors as $username => $author) {
            $typeIds = collect($map[$username] ?? [])
                ->map(fn (string $code) => $types[$code]->id ?? null)
                ->filter()
                ->all();

            $author->authorTypes()->sync($typeIds);
        }
    }
}
