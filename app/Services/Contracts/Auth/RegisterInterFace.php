<?php

namespace App\Services\Contracts\Auth;

use App\Models\User;

interface RegisterInterFace
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function registerUser(array $data): User;
}
