<?php

namespace App\Services\Contracts\Auth;

use App\Exceptions\AuthError;
use App\Models\User;

interface AuthInterface
{
    /**
     * @param  array<string, mixed>  $data
     *
     * @throws AuthError
     */
    public function authenticateUser(array $data): User;

    public function logoutUser(): void;
}
