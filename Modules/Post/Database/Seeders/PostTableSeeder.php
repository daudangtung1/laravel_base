<?php

namespace Modules\Post\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Author\Entities\Author;
use Modules\Post\Entities\Post;
use Modules\Post\Entities\PostCategory;

/**
 * Seed dữ liệu bài viết: danh mục + bài viết + gắn tác giả (bảng authorables).
 * Chạy sau AuthorTableSeeder: php artisan db:seed --class="Modules\Post\Database\Seeders\PostTableSeeder"
 */
class PostTableSeeder extends Seeder
{
    public function run()
    {
        $categories = $this->seedCategories();
        $posts      = $this->seedPosts($categories);

        $this->attachAuthors($posts);
    }

    protected function seedCategories(): array
    {
        $data = [
            ['name' => 'Hội họa', 'slug' => 'hoi-hoa', 'description' => 'Tin tức về hội họa', 'sort_order' => 1],
            ['name' => 'Điêu khắc', 'slug' => 'dieu-khac', 'description' => 'Tin tức về điêu khắc', 'sort_order' => 2],
            ['name' => 'Nhiếp ảnh', 'slug' => 'nhiep-anh', 'description' => 'Tin tức nhiếp ảnh', 'sort_order' => 3],
            ['name' => 'Triển lãm', 'slug' => 'trien-lam', 'description' => 'Sự kiện triển lãm', 'sort_order' => 4],
        ];

        $categories = [];
        foreach ($data as $row) {
            $categories[$row['slug']] = PostCategory::updateOrCreate(
                ['slug' => $row['slug']],
                $row + ['is_active' => true]
            );
        }

        return $categories;
    }

    protected function seedPosts(array $categories): array
    {
        $data = [
            [
                'title'          => 'Triển lãm "Sắc màu mùa thu" mở cửa tại Hà Nội',
                'slug'           => 'trien-lam-sac-mau-mua-thu',
                'category'       => 'trien-lam',
                'featured_image' => 'https://picsum.photos/seed/art1/800/450',
                'excerpt'        => 'Triển lãm quy tụ hơn 50 tác phẩm hội họa của các nghệ sĩ đương đại Việt Nam.',
                'content'        => "Triển lãm \"Sắc màu mùa thu\" chính thức khai mạc tại Bảo tàng Mỹ thuật Việt Nam, quy tụ hơn 50 tác phẩm hội họa đặc sắc.\n\nCác tác phẩm trưng bày phản ánh đa dạng phong cách sáng tác, từ cổ điển đến hiện đại, mang đến cho người xem trải nghiệm thị giác phong phú.",
                'published_at'   => now()->subDays(3),
            ],
            [
                'title'          => 'Nghệ thuật điêu khắc đá Non Nước - Di sản trăm năm',
                'slug'           => 'dieu-khac-da-non-nuoc',
                'category'       => 'dieu-khac',
                'featured_image' => 'https://picsum.photos/seed/art2/800/450',
                'excerpt'        => 'Làng nghề điêu khắc đá Non Nước Đà Nẵng được công nhận là di sản văn hóa phi vật thể.',
                'content'        => "Làng nghề điêu khắc đá Non Nước nằm dưới chân núi Ngũ Hành Sơn, có lịch sử hơn 400 năm.\n\nCác nghệ nhân tại đây đã tạo ra hàng nghìn tác phẩm tinh xảo từ những khối đá thô sơ.",
                'published_at'   => now()->subDays(6),
            ],
            [
                'title'          => 'Cuộc thi nhiếp ảnh "Việt Nam trong tôi" 2026',
                'slug'           => 'cuoc-thi-nhiep-anh-viet-nam-trong-toi',
                'category'       => 'nhiep-anh',
                'featured_image' => 'https://picsum.photos/seed/art3/800/450',
                'excerpt'        => 'Cuộc thi nhiếp ảnh thường niên với tổng giá trị giải thưởng lên đến 500 triệu đồng.',
                'content'        => "Ban tổ chức chính thức phát động cuộc thi nhiếp ảnh \"Việt Nam trong tôi\" năm 2026 với chủ đề thiên nhiên và con người.\n\nThời gian nhận tác phẩm từ 01/06 đến 30/09. Lễ trao giải dự kiến tổ chức vào tháng 12.",
                'published_at'   => now()->subDays(9),
            ],
            [
                'title'          => 'Họa sĩ trẻ Việt tỏa sáng tại Biennale Venice',
                'slug'           => 'hoa-si-tre-viet-bien-nale-venice',
                'category'       => 'hoi-hoa',
                'featured_image' => 'https://picsum.photos/seed/art4/800/450',
                'excerpt'        => 'Tác phẩm của họa sĩ Nguyễn Minh được chọn trưng bày tại Biennale Venice 2026.',
                'content'        => "Họa sĩ trẻ Nguyễn Minh vừa có vinh dự được chọn trưng bày tác phẩm tại Biennale Venice 2026 - một trong những sự kiện nghệ thuật uy tín nhất thế giới.\n\nTác phẩm \"Dòng chảy\" sử dụng kỹ thuật sơn mài truyền thống kết hợp chất liệu hiện đại.",
                'published_at'   => now()->subDays(12),
            ],
            [
                'title'          => 'Chân dung nghệ sĩ trẻ qua lăng kính máy ảnh analog',
                'slug'           => 'chan-dung-nghe-si-tre-leng-kinh-analog',
                'category'       => 'nhiep-anh',
                'featured_image' => 'https://picsum.photos/seed/art6/800/450',
                'excerpt'        => 'Hoàng Thị Lan đưa máy ảnh film về trước mạng xã hội và tìm lại cảm giác chậm.',
                'content'        => "Từ vài năm trở lại đây, phong cách ảnh film 35mm trở lại được nhiều nghệ sĩ trẻ quan tâm.\n\nHoàng Thị Lan chia sẻ hành trình tìm lại những tấm ảnh chậm, nhiều lớp nhiễu và cảm xúc chân thật hơn.",
                'published_at'   => now()->subDays(15),
            ],
            [
                'title'          => 'Phong sương thu ở phố cổ Hội An',
                'slug'           => 'phong-suong-thu-o-pho-co-hoi-an',
                'category'       => 'trien-lam',
                'featured_image' => 'https://picsum.photos/seed/art7/800/450',
                'excerpt'        => 'Triển lãm ảnh Phong sương thu lần thứ tư mở cửa tại Hội An.',
                'content'        => "Triển lãm Phong sương thu quy tụ 120 tác phẩm chụp trong hai tháng mùa mưa tại phố cổ Hội An.\n\nTriển lãm mở cửa miễn phí đến hết tháng, kèm tọa đàm với các nghệ sĩ tham gia.",
                'published_at'   => now()->subDays(18),
            ],
            [
                'title'          => 'Bảo tồn nghệ thuật điêu khắc trên gỗ',
                'slug'           => 'bao-ton-nghe-thuat-dieu-khac-tren-go',
                'category'       => 'dieu-khac',
                'featured_image' => 'https://picsum.photos/seed/art8/800/450',
                'excerpt'        => 'Dự án bảo tồn 200 tác phẩm điêu khắc trên gỗ thuộc di sản sẽ được triển khai tại ba tỉnh phía Bắc.',
                'content'        => "Dự án bảo tồn tập trung vào việc số hóa và sửa chữa 200 tác phẩm điêu khắc trên gỗ bị hư hỏng.\n\nCác nghệ nhân trực tiếp tham gia quá trình truyền nghề và ghi chép lại kỹ thuật truyền thống.",
                'published_at'   => now()->subDays(4),
            ],
            [
                'title'          => 'Phòng tranh giấy dầu trong không gian nhỏ',
                'slug'           => 'phong-tranh-giay-dau-trong-khong-gian-nho',
                'category'       => 'hoi-hoa',
                'featured_image' => 'https://picsum.photos/seed/art9/800/450',
                'excerpt'        => 'Xu hướng tranh giấy dầu giảm giá giúp nhiều người bắt đầu sưu tầm nghệ thuật.',
                'content'        => "Với mức giá dễ chịu và chất liệu thanh lịch, tranh giấy dầu đang được nhiều gia đình lựa chọn.\n\nCác nghệ sĩ trẻ cũng dễ dàng tiếp cận hơn khi chỉ cần giá vải và chất sơn dầu.",
                'published_at'   => now()->subDays(1),
            ],
        ];

        $posts = [];
        foreach ($data as $row) {
            $category = $categories[$row['category']] ?? null;

            $posts[$row['slug']] = Post::updateOrCreate(
                ['slug' => $row['slug']],
                [
                    'title'          => $row['title'],
                    'category_id'    => $category?->id,
                    'excerpt'        => $row['excerpt'],
                    'content'        => $row['content'],
                    'featured_image' => $row['featured_image'],
                    'status'         => 'published',
                    'published_at'   => $row['published_at'],
                ]
            );
        }

        return $posts;
    }

    /**
     * Gắn tác giả cho bài viết qua bảng nối authorables.
     * Bỏ qua nếu bảng authors chưa có dữ liệu.
     */
    protected function attachAuthors(array $posts): void
    {
        if (! Author::query()->exists()) {
            return;
        }

        $map = [
            'trien-lam-sac-mau-mua-thu'          => ['nguyen-van-minh', 'pham-quoc-bao'],
            'dieu-khac-da-non-nuoc'              => ['pham-quoc-bao'],
            'cuoc-thi-nhiep-anh-viet-nam-trong-toi' => ['hoang-thi-lan'],
            'hoa-si-tre-viet-bien-nale-venice'   => ['nguyen-van-minh'],
            'chan-dung-nghe-si-tre-leng-kinh-analog' => ['hoang-thi-lan'],
            'phong-suong-thu-o-pho-co-hoi-an'    => ['hoang-thi-lan', 'pham-quoc-bao'],
            'bao-ton-nghe-thuat-dieu-khac-tren-go' => ['pham-quoc-bao'],
            'phong-tranh-giay-dau-trong-khong-gian-nho' => ['nguyen-van-minh'],
        ];

        foreach ($posts as $slug => $post) {
            $usernames = $map[$slug] ?? [];

            $post->authors()->sync(
                collect($usernames)
                    ->map(fn (string $username) => Author::query()
                        ->where('username', $username)
                        ->value('id'))
                    ->filter()
                    ->all()
            );
        }
    }
}
