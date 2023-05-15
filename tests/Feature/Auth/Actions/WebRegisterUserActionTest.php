<?php

use App\Actions\Auth\Web\WebRegisterUserAction;
use App\Models\User;

beforeEach(function () {
    $this->registerUserAction = app(WebRegisterUserAction::class);
    $this->app['request']->setLaravelSession($this->app['session']->driver('array'));
});

test('it returns user model after registering user successfully via api', function () {
    $data = [
        'email' => fake()->safeEmail(),
        'password' => 'password',
        'first_name' => fake()->firstName,
        'last_name' => fake()->lastName,
        'phone_number' => fake()->phoneNumber,
    ];

    $result = $this->registerUserAction->registerUser($data);
    expect($result)
        ->toBeInstanceOf(User::class);
});
