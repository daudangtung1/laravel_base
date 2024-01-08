<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i <= 10; $i++) {
            User::create([
                'name' => 'name_' . $i,
                'email' => 'name_' . $i . '@gmail.test',
                'password' => bcrypt('11111111'),
                'gender' => rand(0, 2)
            ]);
        }
    }
}
