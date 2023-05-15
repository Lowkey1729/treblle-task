<?php

namespace App\Services\Contracts\Auth;

use App\Models\User;

interface AuthInterface
{
    public function authenticateUser(array $data): User;
}
