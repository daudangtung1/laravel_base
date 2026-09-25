<?php

namespace Modules\Author\Services;

use Illuminate\Support\Facades\Hash;
use Modules\Author\Entities\Author;
use Modules\Author\Repositories\AuthorRepository;

class AuthorApiService
{
    protected AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

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
     */
    public function issueToken(Author $author, string $deviceName = 'api'): string
    {
        // Revoke existing tokens (single session policy)
        $author->tokens()->delete();

        return $author->createToken($deviceName)->plainTextToken;
    }

    /**
     * Revoke all tokens for the given author (logout).
     */
    public function revokeTokens(Author $author): void
    {
        $author->tokens()->delete();
    }

    /**
     * Get the author profile with author types eager loaded.
     */
    public function getProfile(Author $author): Author
    {
        return $author->load('authorTypes');
    }

    /**
     * Update the author profile.
     * Handles password hashing when a new password is provided.
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

        return $author->fresh('authorTypes');
    }
}
