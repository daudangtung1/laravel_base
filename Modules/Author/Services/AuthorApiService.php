<?php

namespace Modules\Author\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Modules\Author\Entities\Author;
use Modules\Author\Repositories\AuthorRepository;

class AuthorApiService
{
    /**
     * Cache TTL in seconds (10 minutes).
     */
    const PROFILE_TTL = 600;

    /**
     * Cache key prefix for author profiles.
     */
    const PROFILE_KEY = 'author_profile_';

    protected AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /*---------------------------------------------------------------------------
    | Cache helpers
    |---------------------------------------------------------------------------*/

    /**
     * Build the cache key for a given author's profile.
     */
    protected function profileCacheKey(int $authorId): string
    {
        return self::PROFILE_KEY . $authorId;
    }

    /**
     * Forget the cached profile for a given author.
     */
    protected function forgetProfileCache(int $authorId): void
    {
        Cache::forget($this->profileCacheKey($authorId));
    }

    /*---------------------------------------------------------------------------
    | Auth
    |---------------------------------------------------------------------------*/

    /**
     * Attempt to authenticate an author with email and password.
     * Returns the Author model on success, or null on failure.
     */
    public function attemptLogin(string $email, string $password): ?Author
    {
        /** @var Author|null $author */
        $author = $this->authorRepository->findByField('email', $email);

        if (! $author || ! Hash::check($password, $author->password)) {
            return null;
        }

        if (! $author->is_active) {
            return null;
        }

        return $author;
    }

    /**
     * Issue a new Sanctum API token for the given author.
     * Revokes all existing tokens first to enforce single-session.
     * Also invalidates the profile cache so a fresh load occurs on next GET /me.
     */
    public function issueToken(Author $author, string $deviceName = 'api'): string
    {
        $author->tokens()->delete();

        // Invalidate profile cache on new login
        $this->forgetProfileCache($author->id);

        return $author->createToken($deviceName)->plainTextToken;
    }

    /**
     * Revoke all tokens for the given author (logout).
     * Also clears the profile cache.
     */
    public function revokeTokens(Author $author): void
    {
        $author->tokens()->delete();

        // Clear cache on logout
        $this->forgetProfileCache($author->id);
    }

    /*---------------------------------------------------------------------------
    | Profile
    |---------------------------------------------------------------------------*/

    /**
     * Get the author profile with author types eager loaded.
     *
     * Result is cached per author ID for PROFILE_TTL seconds.
     * Cache is automatically invalidated on updateProfile() / logout() / login().
     */
    public function getProfile(Author $author): Author
    {
        $key = $this->profileCacheKey($author->id);

        return Cache::remember($key, self::PROFILE_TTL, function () use ($author) {
            return $author->load('authorTypes');
        });
    }

    /**
     * Update the author profile.
     * Handles password hashing when a new password is provided.
     * Invalidates the profile cache immediately after saving.
     */
    public function updateProfile(Author $author, array $data): Author
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        // Remove confirmation field — not a real column
        unset($data['password_confirmation']);

        $this->authorRepository->updateById($data, $author->id);

        // Invalidate stale cache
        $this->forgetProfileCache($author->id);

        return $author->fresh('authorTypes');
    }
}

