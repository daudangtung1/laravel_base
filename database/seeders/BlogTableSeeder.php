<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogTableSeeder extends Seeder
{
    public function run()
    {
        Blog::truncate();
        for ($i = 1; $i <= 10; $i++) {
            Blog::create([
                'name' => 'name_' . $i,
                'content' => 'content ' . $i,
                'index' => $i
            ]);
        }
    }
}
