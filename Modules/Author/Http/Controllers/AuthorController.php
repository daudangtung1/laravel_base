<?php

namespace Modules\Author\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Author\Entities\Author;
use Modules\Author\Services\AuthorService;

class AuthorController extends Controller
{
    protected $module = 'author';
    protected $authorService;

    public function __construct(
        AuthorService $authorService
    ) {
        $this->authorService = $authorService;
    }

    public function index(Request $request)
    {
        $authors = $this->authorService->getListByAdmin();
        return view($this->module . '::author.index', compact('authors'));
    }

    public function create()
    {
        return view($this->module . '::author.detail');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $input = $request->only([
                'user_name',
                'slug',
                'email',
                'password',
                'full_name',
                'birth_day',
            ]);

            //TODO: add to service and repo
            $user = User::create([
                'email' => $input['email'],
                'password' => bcrypt('123456'),
                'role' => 1 //TODO: create input role laterinput
            ]);
            unset($input['email']);
            unset($input['password']);
            $input['user_id'] = $user->id;
            $input['author_type_id'] = 1; //TODO: input add author type id
            if ($request->hasFile('avatar')) {
                $input['avatar'] = uploadImage($request->file('avatar'), $user->id);
            }

            $author = Author::create($input);

            if ($user && $author) {
                DB::commit();
                return redirect()->back()->with('success', 'Tạo tài khoản thành công');
            }
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi, vui lòng thử lại sau');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi, vui lòng thử lại sau');
        }
    }

    public function show($id)
    {
        $author = $this->authorService->findById($id);
        return view($this->module . '::author.detail', compact('author'));
    }

    public function edit($id)
    {
        return view('author::edit');
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
