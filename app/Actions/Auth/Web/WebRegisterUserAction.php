<?php

namespace App\Actions\Auth\Web;

use App\Models\User;
use App\Services\Concerns\Auth\Register;
use App\Services\Contracts\Auth\RegisterInterFace;
use Illuminate\Support\Facades\Auth;

class WebRegisterUserAction implements RegisterInterFace
{
    use Register;

    /**
     * @param  array<string, mixed>  $data
     */
    public function registerUser(array $data): User
    {
        $user = $this->createUser($data);

        Auth::login($user);
        request()->session()->regenerate();

        return $user;
    }
}
