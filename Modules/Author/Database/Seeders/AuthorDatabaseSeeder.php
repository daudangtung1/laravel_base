<?php

namespace Modules\Author\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Author\Database\Seeders\AuthorTypeSeederTableSeeder;

class AuthorDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(AuthorTypeSeederTableSeeder::class);
    }
}
