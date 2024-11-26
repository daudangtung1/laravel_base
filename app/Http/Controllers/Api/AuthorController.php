<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Author\Entities\Author;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\User;
use App\Utils\Constant;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->all() ?? null;
        if (blank($input)) {
            $data = Author::all();
        } else {
            $data = Author::where('user_name', 'like', '%' . $input['query'] . '%')->get();
        }

        // $data = Cache::remember('author', 60, function () use ($input) {
        //     if (blank($input)) {
        //         $dataRes = Author::all();
        //     } else {
        //         if (Cache::has($input)) {
        //             $dataRes = Cache::get($input);
        //         } else {
        //             $dataRes = Author::where('user_name', 'like', '%' . $input . '%')->get();
        //             Cache::tags(['author'])->put($input, $dataRes, now()->addMinutes(60));
        //         }
        //     }
        //     return $dataRes;
        // });

        return $this->responseSuccess($data, 'Get data success');
    }

    public function show($slug)
    {
        $data = Author::where('slug', $slug)->first();
        if (!$data) {
            return $this->responseFail('Author not found');
        }

        return $this->responseSuccess($data, 'Get author success');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $user = User::create([
                'email' => $input['email'],
                'password' => bcrypt($input['password']),
                'role' => Constant::GUEST_TYPE['AUTHOR'],
            ]);

            if (!$user) {
                DB::rollBack();
                return $this->responseFail('Create user fail');
            }

            Author::create([
                'user_id' => $user->id,
                'user_name' => $input['user_name'],
                'full_name' => $input['full_name'],
                'birth_day' => Carbon::parse($input['birth_day']),
                'description' => $input['description'],
                'address' => $input['address'],
                'is_active' => 1,
                'is_block' => 0,
                'author_type_id' => 1,
                'slug' => $input['slug']
            ]);

            DB::commit();
            return $this->responseCreatedSuccess(null, 'Create user success');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e);
            return $this->responseFail('Create user fail');
        }
    }

    public function changeStatus(Request $request, $slug)
    {
        $input = $request->all();
        $author = Author::where('slug', $slug)->first();
        if (!$author) {
            return $this->responseFail('Author not found');
        }

        $author->is_active = $input['is_active'];
        $author->save();
        return $this->responseSuccess(null, 'Update succees');
    }
}
