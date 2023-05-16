<?php

namespace App\Services\Contracts\User;

use App\Models\User;

interface UserInterface
{
    public function viewUserDetails(string $uuid): User;

    /**
     * @param string $uuid
     * @param array<string, mixed> $data
     * @return User
     */
    public function editUserDetails(string $uuid, array $data): User;

}
