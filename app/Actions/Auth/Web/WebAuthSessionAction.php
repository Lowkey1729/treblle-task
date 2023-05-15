<?php

namespace App\Actions\Auth\Web;

use App\Exceptions\AuthError;
use App\Models\User;
use App\Services\Concerns\Auth\Login;
use App\Services\Contracts\Auth\AuthInterface;
use Illuminate\Support\Facades\Auth;

class WebAuthSessionAction implements AuthInterface
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

        Auth::login($user);
        request()->session()->regenerate();

        return $user;
    }

    public function logoutUser(): void
    {
        Auth::logout();
        request()->session()->invalidate();

        request()->session()->regenerateToken();
    }
}
