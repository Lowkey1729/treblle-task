<?php

namespace App\Actions\Auth;

use App\Exceptions\PasswordError;
use App\Models\User;
use App\Services\Contracts\Auth\PasswordInterface;
use Illuminate\Support\Facades\Hash;

class PasswordAction implements PasswordInterface
{

    /**
     * @throws PasswordError
     */
    public function updatePassword(User $user, array $data): void
    {
        if (!Hash::check($data['old_password'], $user->password)) {
            throw new PasswordError('The retrieved password does not match our record.');
        }

        $user->update([
            'password' => bcrypt($data['password']),
        ]);
    }
}
