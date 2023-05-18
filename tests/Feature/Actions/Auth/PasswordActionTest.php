<?php

use App\Actions\Auth\PasswordAction;
use App\Exceptions\PasswordError;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    $this->userAction = app(PasswordAction::class);
    $this->app['request']->setLaravelSession($this->app['session']->driver('array'));
});

test('it can update user password', function () {
    $user = User::factory()->create();
    $data = [
        'password' => fake()->password,
        'old_password' => 'password'
    ];
    $this->userAction->updatePassword($user, $data);

    expect(Hash::check($data['password'], $user->password))
        ->toBeTrue();

});

