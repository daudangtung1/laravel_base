<?php

namespace Modules\Author\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorTypeSeederTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Basic',
            ],
            [
                'name' => 'Pro',
                'color' => '#000',
            ],
        ];

        DB::table('author_types')->insert($data);
    }
}
