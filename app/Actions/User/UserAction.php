<?php

namespace App\Actions\User;

use App\Exceptions\UserError;
use App\Models\User;
use App\Services\Contracts\User\UserInterface;

class UserAction implements UserInterface
{

    /**
     * @throws UserError
     */
    public function viewUserDetails(string $uuid): User
    {
        $user = User::query()->where('uuid', $uuid)->first();
        if (is_null($user)) {
            throw new UserError('User does not exist');
        }

        return $user;
    }

    /**
     * @param string $uuid
     * @param array<string, mixed> $data
     * @return User
     * @throws UserError
     */
    public function editUserDetails(string $uuid, array $data): User
    {
        $user = User::query()->where('uuid', $uuid)->first();
        if (is_null($user)) {
            throw new UserError('User does not exist');
        }

       return tap($user)->update([
           'email' => $data['email'],
           'first_name' => $data['first_name'],
           'last_name' => $data['last_name'],
           'phone_number' => $data['phone_number']
       ]);
    }
}
