<?php

use App\Models\User;

test('it validates registration request', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $this->put(route('auth.web.update.password'), [])
        ->assertRedirect()
        ->assertSessionHasErrors(
            [
                'password',
                'old_password',
            ]
        );

});

test('it redirects back with error response when an invalid old password is entered', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $this->put(route('auth.web.update.password'), [
        'password' => 'password',
        'old_password' => fake()->password(19),
        'password_confirmation' => 'password'
    ]
    )
        ->assertRedirect()
        ->assertSessionHas('error');

});

test('it successfully updates user password', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $password = fake()->password(9);
    $this->put(route('auth.web.update.password'), [
            'password' => $password,
            'old_password' => 'password',
            'password_confirmation' => $password
        ]
    )
        ->assertRedirect()
        ->assertSessionHas('success');

});
