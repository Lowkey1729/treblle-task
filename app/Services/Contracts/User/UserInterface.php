<?php

namespace App\Services\Contracts\User;

use App\Models\User;

interface UserInterface
{
    public function viewUserDetails(User $user): User;

    /**
     * @param  array<string, mixed>  $data
     */
    public function editUserDetails(User $user, array $data): User;
}
