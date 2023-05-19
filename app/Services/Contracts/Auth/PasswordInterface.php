<?php

namespace App\Services\Contracts\Auth;

use App\Models\User;

interface PasswordInterface
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function updatePassword(User $user, array $data): void;
}
