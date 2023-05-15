<?php

namespace App\Actions\Auth;

use App\Exceptions\AuthError;
use App\Models\User;
use App\Services\Concerns\Auth\Login;
use App\Services\Contracts\Auth\AuthInterface;

class AuthAPISessionAction implements AuthInterface
{
    use Login;

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws AuthError
     */
    public function authenticateUser(array $data): User
    {
        $this->failedAuthentication($data);
        $user = $this->getUser();

        $token = $user->createToken(sprintf('%s token', $user->email))->plainTextToken;
        $user->plainTextToken = $token;

        return $user;

    }

    public function logoutUser(): void
    {
        request()->user()?->deleteAccessToken();
    }
}
