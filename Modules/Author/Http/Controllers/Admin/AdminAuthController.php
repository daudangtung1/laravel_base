<?php

namespace Modules\Author\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Author\Http\Requests\AdminLoginRequest;
use Modules\Author\Services\AdminAuthService;

class AdminAuthController extends Controller
{
    protected AdminAuthService $adminAuthService;

    public function __construct(AdminAuthService $adminAuthService)
    {
        $this->adminAuthService = $adminAuthService;
    }

    /**
     * Show the admin login form.
     * Redirect to authors dashboard if already authenticated.
     */
    public function create()
    {
        if ($this->adminAuthService->isAuthenticated()) {
            return redirect()->route('admin.authors.index');
        }

        return view('author::admin.auth.login');
    }

    /**
     * Handle the login form submission.
     */
    public function store(AdminLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember    = $request->boolean('remember');

        if (! $this->adminAuthService->login($credentials, $remember)) {
            return back()
                ->withErrors(['email' => 'Email hoặc mật khẩu không chính xác.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.authors.index'));
    }

    /**
     * Log out the authenticated admin and redirect to the login page.
     */
    public function destroy(Request $request)
    {
        $this->adminAuthService->logout($request);

        return redirect()
            ->route('author.login')
            ->with('success', 'Bạn đã đăng xuất thành công.');
    }
}
