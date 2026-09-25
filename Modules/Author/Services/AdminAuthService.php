<?php

namespace Modules\Author\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Author\Repositories\AdminAuthRepository;

class AdminAuthService
{
    protected AdminAuthRepository $adminAuthRepository;

    public function __construct(AdminAuthRepository $adminAuthRepository)
    {
        $this->adminAuthRepository = $adminAuthRepository;
    }

    /**
     * Check whether the admin guard is already authenticated.
     */
    public function isAuthenticated(): bool
    {
        return Auth::guard('admin')->check();
    }

    /**
     * Attempt to authenticate an admin user.
     *
     * @param array{email: string, password: string} $credentials
     * @param bool $remember
     */
    public function login(array $credentials, bool $remember = false): bool
    {
        // Verify the user exists before attempting (repository layer involvement)
        $admin = $this->adminAuthRepository->findByEmail($credentials['email']);

        if (! $admin) {
            return false;
        }

        return Auth::guard('admin')->attempt($credentials, $remember);
    }

    /**
     * Log out the currently authenticated admin and invalidate the session.
     */
    public function logout(Request $request): void
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    /**
     * Get the currently authenticated admin user.
     */
    public function getAuthenticatedAdmin()
    {
        return Auth::guard('admin')->user();
    }
}
