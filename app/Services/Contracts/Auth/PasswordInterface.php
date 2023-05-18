<?php

namespace App\Services\Contracts\Auth;

use App\Models\User;

interface PasswordInterface
{
    /**
     * @param User $user
     * @param array<string, mixed> $data
     * @return void
     */
    public function updatePassword(User $user, array $data): void;

}
