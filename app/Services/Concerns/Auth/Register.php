<?php

namespace App\Services\Concerns\Auth;

use App\Models\User;

trait Register
{
    public function createUser(array $data): User
    {
        return User::query()->create($this->getData($data));
    }

    protected function getData(array $data): array
    {
        return [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'password' => bcrypt($data['password']),
            'email_verified_at' => now(),
        ];
    }
}
