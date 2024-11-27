<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Service\AuthService;
use App\Service\UserService;
use Modules\Author\Services\AuthorService;
use Illuminate\Http\Request;
use App\Utils\Constant;
use Exception;
use Modules\Author\Entities\Author;
use Modules\Admin\Services\AdminService;

class AuthController extends Controller
{
    protected $authService;
    protected $userService;
    protected $authorService;
    protected $adminService;

    public function __construct(
        AuthService $authService,
        UserService $userService,
        AuthorService $authorService,
        AdminService $adminService
    ) {
        $this->authService = $authService;
        $this->userService = $userService;
        $this->authorService = $authorService;
        $this->adminService = $adminService;
    }

    public function login(Request $request)
    {
        $input = $request->only([
            'email',
            'password',
        ]);

        return $this->authService->login($input);
    }

    public function logout()
    {
        $user = auth('sanctum')->user();
        if ($user) {
            $user->currentAccessToken()->delete();
            return $this->responseSuccess(null, 'Logout success');
        }

        return $this->responseFail('Logout fail');
    }

    public function register(Request $request)
    {
        try {
            $this->transactionStart();
            $input = $request->only([
                'email',
                'password',
                'role',
                'user_name',
                'full_name',
                'birth_day',
                'description',
                'address',
            ]);

            if ($input['role'] !== Constant::GUEST_TYPE['AUTHOR'] || $input['role'] !== Constant::GUEST_TYPE['MEMBER']) {
                $this->transactionStop();
                return $this->responseFail('Create user error');
            }

            $userInput = [
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
            ];

            $user = $this->createUser($input);

            if (!$user) {
                $this->transactionStop();
                return $this->responseFail('Create user error');
            }

            if ($input['role'] !== Constant::GUEST_TYPE['AUTHOR']) {
                $author = $this->createAuthor($input);
            } else {
                $user = $this->createMember($input);
            }

            $this->transactionComplete();
        } catch (Exception $e) {
            $this->transactionStop();
            return $this->responseFail('Create user error');
        }
    }

    private function createUser($input)
    {
        $userInput = [
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
            'role' => $input['role'],
        ];

        return $this->userService->store($userInput);
    }

    private function createAuthor($input)
    {
        $authorInput = [
            'user_name' => $input['user_name'],
            'full_name' => $input['full_name'],
            'birth_day' => $input['birth_day'],
            'description' => $input['description'],
            'address' => $input['address'],
            'is_active' => Constant::NO,
            'is_block' => Constant::NO,
            'author_type_id' => Constant::DEFAULT_AUTHOR_TYPE_ID,
        ];

        return $this->authorService->store($authorInput);
    }

    private function createMember($input) {}

    /*------ Auth amin ------*/
    public function loginAdmin()
    {
        return view('pages.auth.admin-login');
    }

    public function postLoginAdmin(Request $request)
    {
        $input = $request->only([
            'email',
            'password',
        ]);

        $admin = $this->adminService->findByField('email', $input['email']);
        if (!$admin) {
            return redirect()->back()->with('error', 'User not found!');
        }

        $checkLogin = $this->adminService->login($input);
        if ($checkLogin == false) {
            return redirect()->back()->with('error', 'Invalid email or password');
        }

        return redirect()->route('admin.dashboard');
    }

    public function logoutAdmin()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.getLogin');
    }
}
