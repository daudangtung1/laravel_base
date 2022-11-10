<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    protected $gender;
    public function __construct(User $gender_list)
    {
        $this->gender_list = $gender_list;
    }
    public function index()
    {
        $users = User::all();
        $gender_list = $this->gender_list->gender_1;

        $arr = [];
        foreach ($users as $key => $user) {
            $arr[$key] = [
                'name' => $user->name,
                'gender' => $gender_list[$user->gender],
            ];
        };
        dd($arr);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
