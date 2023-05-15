<?php

namespace App\Actions\Auth\API;

use App\Models\User;
use App\Services\Concerns\Auth\Register;
use App\Services\Contracts\Auth\RegisterInterFace;

class APIRegisterUserAction implements RegisterInterFace
{
    use Register;

    /**
     * @param  array<string, mixed>  $data
     */
    public function registerUser(array $data): User
    {
        $user = $this->createUser($data);
        $token = $user->createToken(sprintf('%s token', $user->email))->plainTextToken;
        $user->plainTextToken = $token;

        return $user;
    }
}
