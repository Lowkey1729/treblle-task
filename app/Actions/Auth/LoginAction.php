<?php

namespace App\Actions\Auth;

use App\Exceptions\AuthError;
use App\Models\User;
use App\Services\Concerns\Auth\Login;
use App\Services\Contracts\Auth\AuthInterface;
use Illuminate\Support\Facades\Auth;

class LoginAction implements AuthInterface
{
    use Login;

    /**
     * @param array<string, mixed> $data
     *
     * @throws AuthError
     */
    public function authenticateUser(array $data): User
    {
        $this->failedAuthentication($data);
        $user = $this->getUser();

        return request()->wantsJson() ?
            $this->authenticateViaAPI($user) :
            $this->authenticateViaWeb($user);

    }

    protected function authenticateViaAPI(User $user): User
    {
        $token = $user->createToken(sprintf('%s token', $user->email))->plainTextToken;
        $user->plainTextToken = $token;
        return $user;
    }

    protected function authenticateViaWeb(User $user): User
    {
        Auth::login($user);
        return $user;
    }
}
