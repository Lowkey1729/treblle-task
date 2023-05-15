<?php

use App\Actions\Auth\API\APIRegisterUserAction;
use App\Models\User;

beforeEach(function () {
    $this->registerUserAction = app(APIRegisterUserAction::class);
});

test('it returns user model after registering user successfully via api', function () {
    request()->headers->set('Accept', 'application/json');
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
