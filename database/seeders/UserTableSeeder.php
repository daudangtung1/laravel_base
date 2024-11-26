<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Modules\Author\Entities\Author;
use App\Utils\Constant;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        try {
            DB::beginTransaction();
            for ($i = 1; $i <= 2; $i++) {

                $user = User::create([
                    'email' => 'Author_' . $i . '@gmail.com',
                    'password' => bcrypt('123456'),
                    'role' => Constant::GUEST_TYPE['AUTHOR'],
                ]);

                if (!$user) {
                    DB::rollBack();
                    dd('false');
                }

                Author::create([
                    'user_id' => $user->id,
                    'user_name' => 'author' . $i,
                    'full_name' => 'author' . $i,
                    'birth_day' => Carbon::parse('02/05/1995'),
                    'description' => 'author',
                    'address' => 'author',
                    'is_active' => 1,
                    'is_block' => 0,
                    'author_type_id' => 1,
                    'slug' => 'author-' . $i 
                ]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e);
            dd($e);
        }
    }
}
