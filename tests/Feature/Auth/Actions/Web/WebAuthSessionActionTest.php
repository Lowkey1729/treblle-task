<?php

use App\Actions\Auth\Web\WebAuthSessionAction;
use App\Exceptions\AuthError;
use App\Models\User;

beforeEach(function () {
    $this->authWebSessionAction = app(WebAuthSessionAction::class);
    $this->app['request']->setLaravelSession($this->app['session']->driver('array'));
});

test('it throws exception when the credentials are incorrect', function () {
    $data = [
        'email' => 'foo@gmail.com',
        'password' => 'bar',
    ];

    $this->authWebSessionAction->authenticateUser($data);

})->throws(AuthError::class, 'The provided credentials are incorrect.', 401);

test('it throws an exception when the email is not verified', function () {
    $user = User::factory()->create();
    $user->update(['email_verified_at' => null]);
    $data = [
        'email' => $user->email,
        'password' => 'password',
    ];

    $this->authWebSessionAction->authenticateUser($data);
})->throws(AuthError::class, 'Email has not been verified.', 401);

test('it returns user model after authenticating user successfully via web', function () {

    $user = User::factory()->create();
    $data = [
        'email' => $user->email,
        'password' => 'password',
    ];

    $result = $this->authWebSessionAction->authenticateUser($data);


    expect($result)
        ->toBeInstanceOf(User::class);

});

test('it can logout a user via web', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $this->authWebSessionAction->logoutUser();

    $this->assertNull(request()->user());
});
