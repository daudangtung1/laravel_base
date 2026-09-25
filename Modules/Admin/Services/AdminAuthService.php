<?php

namespace Modules\Admin\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Admin\Repositories\AdminAuthRepository;

class AdminAuthService
{
    protected AdminAuthRepository $adminAuthRepository;

    public function __construct(AdminAuthRepository $adminAuthRepository)
    {
        $this->adminAuthRepository = $adminAuthRepository;
    }

    /**
     * Determine if the current request is already authenticated as admin.
     */
    public function isAuthenticated(): bool
    {
        return Auth::guard('admin')->check();
    }

    /**
     * Attempt to authenticate an admin user via the admin guard.
     * The repository is consulted first to ensure the user exists before
     * handing off to Laravel's credential verification.
     *
     * @param array{email: string, password: string} $credentials
     * @param bool $remember
     */
    public function login(array $credentials, bool $remember = false): bool
    {
        $admin = $this->adminAuthRepository->findByEmail($credentials['email']);

        if (! $admin) {
            return false;
        }

        return Auth::guard('admin')->attempt($credentials, $remember);
    }

    /**
     * Log out the current admin, invalidate the session and regenerate the CSRF token.
     */
    public function logout(Request $request): void
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    /**
     * Return the currently authenticated admin model instance.
     */
    public function getAuthenticatedAdmin()
    {
        return Auth::guard('admin')->user();
    }
}
