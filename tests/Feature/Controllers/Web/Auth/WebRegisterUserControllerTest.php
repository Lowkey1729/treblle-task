<?php

use App\Providers\RouteServiceProvider;

test('it validates registration request via web', function () {
    $this->post(route('auth.web.register-user'), [])
        ->assertRedirect()
        ->assertSessionHasErrors(
            [
                'email',
                'phone_number',
                'first_name',
                'last_name',
                'password',
                'password_confirmation',
            ]
        );
});

test('it successfully register users', function () {
    $data = [
        'email' => fake()->safeEmail(),
        'password' => 'password',
        'first_name' => fake()->firstName,
        'last_name' => fake()->lastName,
        'phone_number' => fake()->phoneNumber,
        'password_confirmation' => 'password'
    ];
    $result = $this->post(route('auth.web.register-user'), $data);

    $this->assertAuthenticated();
        $result->assertRedirect(RouteServiceProvider::HOME);
});
