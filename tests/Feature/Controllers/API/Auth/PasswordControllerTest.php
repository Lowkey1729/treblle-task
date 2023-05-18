<?php

use App\Models\User;

test('it validates registration request', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $result = $this->putJson(route('auth.update.password'), [])
        ->assertStatus(422)
        ->json();
    expect($result)
        ->toBeArray()
        ->status->toBeString()->toBe('failed')
        ->errorMessage->toBeString()
        ->errors->toBeArray()
        ->data->toBe([]);
});

test('it returns failed response when the old password entered is incorrect', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $result = $this->putJson(route('auth.update.password'), [
        'password' => 'password',
        'old_password' => fake()->password(19),
        'password_confirmation' => 'password'
    ])
        ->assertStatus(200)
        ->json();
    expect($result)
        ->toBeArray()
        ->status->toBeString()->toBe('failed')
        ->errorMessage->toBeString()->toBe('The retrieved password does not match our record.')
        ->errors->toBeArray()
        ->data->toBe([]);
});

test('it returns successful response when a password is updated', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $password = fake()->password;
    $result = $this->putJson(route('auth.update.password'), [
        'password' => $password,
        'old_password' => 'password',
        'password_confirmation' => $password
    ])
        ->assertStatus(200)
        ->json();

    expect($result)
        ->toBeArray()
        ->status->toBeString()->toBe('success')
        ->errorMessage->toBeNull()
        ->errors->toBe([])
        ->data->toBe([]);
});
