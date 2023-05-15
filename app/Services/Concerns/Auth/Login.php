<?php

namespace App\Services\Concerns\Auth;

use App\Exceptions\AuthError;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait Login
{
    protected User|null $user;

    /**
     * This validates the user/admin authentication request
     *
     * @throws AuthError
     */
    protected function failedAuthentication(array $data): void
    {
        /** @var User $user */
        $user = User::query()->where('email', $data['email'])->first();
        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw new AuthError('The provided credentials are incorrect.', 401);
        }

        if (! $user?->hasVerifiedEmail()) {
            throw new AuthError('Email has not been verified.', 401);
        }

        $this->user = $user;
    }

    protected function getUser(): User|null
    {
        return $this->user;
    }
}
