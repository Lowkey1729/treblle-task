<?php

use App\Actions\Auth\AuthSessionAction;
use App\Exceptions\AuthError;
use App\Models\User;

beforeEach(function () {
    $this->loginAction = app(AuthSessionAction::class);
});

test('it throws exception when the credentials are incorrect', function () {
    $data = [
        'email' => 'foo@gmail.com',
        'password' => 'bar',
    ];

    $this->loginAction->authenticateUser($data);

})->throws(AuthError::class, 'The provided credentials are incorrect.', 401);

test('it throws an exception when the email is not verified', function () {
    $user = User::factory()->create();
    $user->update(['email_verified_at' => null]);
    $data = [
        'email' => $user->email,
        'password' => 'password',
    ];

    $this->loginAction->authenticateUser($data);
})->throws(AuthError::class, 'Email has not been verified.', 401);

test('it returns user model after authenticating user successfully via web', function () {
    $user = User::factory()->create();
    $data = [
        'email' => $user->email,
        'password' => 'password',
    ];

    $result = $this->loginAction->authenticateUser($data);
    expect($result)
        ->toBeInstanceOf(User::class);

});

test('it returns user model after authenticating user successfully via api', function () {
    $user = User::factory()->create();
    request()->headers->set('Accept', 'application/json');
    $data = [
        'email' => $user->email,
        'password' => 'password',
    ];

    $result = $this->loginAction->authenticateUser($data);
    expect($result)
        ->toBeInstanceOf(User::class);
});

test('it returns token after authenticating user successfully via api', function () {
    $user = User::factory()->create();
    request()->headers->set('Accept', 'application/json');
    $data = [
        'email' => $user->email,
        'password' => 'password',
    ];

    $result = $this->loginAction->authenticateUser($data);
    expect($result)
        ->toBeObject()
        ->plainTextToken->toBeString();
});
