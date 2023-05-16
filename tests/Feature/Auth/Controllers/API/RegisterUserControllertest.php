<?php

use App\Models\User;

test('it validates registration request', function () {
    $result = $this->postJson(route('auth.register-user'), [])
        ->assertStatus(422)
        ->json();
    expect($result)
        ->toBeArray()
        ->status->toBeString()->toBe('failed')
        ->errorMessage->toBeString()
        ->errors->toBeArray()
        ->data->toBe([]);
});

test('it returns generated token after user has been created', function () {
    $data = [
        'email' => fake()->safeEmail(),
        'password' => 'password',
        'first_name' => fake()->firstName,
        'last_name' => fake()->lastName,
        'phone_number' => fake()->phoneNumber,
    ];

    $result = $this->postJson(route('auth.register-user'), $data)
        ->assertStatus(200)
        ->json();

    expect($result)
        ->toBeArray()
        ->status->toBeString()->toBe('success')
        ->errorMessage->toBeNull()
        ->errors->toBe([])
        ->data->toBeArray()
        ->and($result['data'])
        ->id->toBeNull()
        ->plainTextToken->toBeString();
});
