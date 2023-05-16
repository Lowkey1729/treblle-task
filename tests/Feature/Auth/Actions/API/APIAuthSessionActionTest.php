<?php

use App\Actions\Auth\API\APIAuthSessionAction;
use App\Exceptions\AuthError;
use App\Models\User;

beforeEach(function () {
    $this->authAPISessionAction = app(APIAuthSessionAction::class);
});

test('it throws exception when the credentials are incorrect', function () {
    $data = [
        'email' => 'foo@gmail.com',
        'password' => 'bar',
    ];

    $this->authAPISessionAction->authenticateUser($data);

})->throws(AuthError::class, 'The provided credentials are incorrect.', 401);

test('it returns user model after authenticating user successfully via api', function () {
    $user = User::factory()->create();
    request()->headers->set('Accept', 'application/json');
    $data = [
        'email' => $user->email,
        'password' => 'password',
    ];

    $result = $this->authAPISessionAction->authenticateUser($data);
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

    $result = $this->authAPISessionAction->authenticateUser($data);
    expect($result)
        ->toBeObject()
        ->plainTextToken->toBeString();
});

//test('it can logout a user via api', function () {
//
//    $user = User::factory()->create();
//
//    $this->actingAs($user, 'sanctum');
//
//    $this->authAPISessionAction->logoutUser();
//
//    $this->assertNull(request()->user());
//});
