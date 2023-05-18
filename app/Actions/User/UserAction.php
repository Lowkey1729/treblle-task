<?php

namespace App\Actions\User;

use App\Exceptions\UserError;
use App\Models\User;
use App\Services\Contracts\User\UserInterface;

class UserAction implements UserInterface
{


    public function viewUserDetails(User $user): User
    {
        return $user;
    }

    /**
     * @param User $user
     * @param array<string, mixed> $data
     * @return User
     */
    public function editUserDetails(User $user, array $data): User
    {
        return tap($user)->update([
            'email' => $data['email'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number']
        ]);
    }
}
