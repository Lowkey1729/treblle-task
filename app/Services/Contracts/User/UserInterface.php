<?php

namespace App\Services\Contracts\User;

use App\Models\User;

interface UserInterface
{
    public function viewUserDetails(User $user): User;

    /**
     * @param User $user
     * @param array<string, mixed> $data
     * @return User
     */
    public function editUserDetails(User $user, array $data): User;

}
