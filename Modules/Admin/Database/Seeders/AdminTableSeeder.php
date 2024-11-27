<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\Admin;

class AdminTableSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'email' => 'admin@gmail.com',
            'name' => 'admin1',
            'password' => bcrypt('111111'),
        ]);
    }
}
