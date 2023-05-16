<?php

use App\Models\User;

test('it can validate login request', function () {

    $result = $this->postJson(route('auth.login-user'), [])
        ->assertStatus(422)
        ->json();
    expect($result)
        ->toBeArray()
        ->status->toBeString()->toBe('failed')
        ->errorMessage->toBeString()
        ->errors->toBeArray()
        ->data->toBe([]);
});

test('it returns failed response when the credentials are not correct', function () {
    $data = [
        'email' => 'foo@gmail.com',
        'password' => 'password',
    ];

    $result = $this->postJson(route('auth.login-user'), $data)
        ->assertStatus(401)
        ->json();

    expect($result)
        ->toBeArray()
        ->status->toBeString()->toBe('failed')
        ->errorMessage->toBeString()->toBe('The provided credentials are incorrect.')
        ->errors->toBeArray()
        ->data->toBe([]);
});

test('it returns token after the user is authenticated', function () {
    $user = User::factory()->create();
    $data = [
        'email' => $user->email,
        'password' => 'password',
    ];

    $result = $this->postJson(route('auth.login-user'), $data)
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

test('it returns 401 when an unauthenticated user tries to logout', function () {
    $this->getJson(route('auth.logout-user'))
        ->assertStatus(401)
        ->json();
});

test('user session destroys after token has been deleted', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $this->getJson(route('auth.logout-user'))
        ->assertStatus(200);

});
