<?php

use App\Actions\User\UserAction;
use App\Exceptions\UserError;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

beforeEach(function () {
    $this->userAction = app(UserAction::class);
});

test('it throws an error when the user to be viewed can not be found', function () {
    $this->userAction->viewUserDetails('foo');
})->throws(UserError::class, 'User does not exist');

test('it returns user model after the user is found', function () {
    $user = User::factory()->create();

    $result = $this->userAction->viewUserDetails($user->uuid);

    expect($result)
        ->toBeInstanceOf(User::class);
});

test('it throws an error when the user to update cannot be found', function () {
    $this->userAction->editUserDetails('foo', []);
})->throws(UserError::class, 'User does not exist');

test('it can update the user details ', function () {
    $user = User::factory()->create();
    $data = [
        'email' => 'mojeed@gmail.com',
        'first_name' => 'Olarewaju',
        'last_name' => 'Mojeed',
        'phone_number' => '+234901078012'
    ];
    $result = $this->userAction->editUserDetails($user->uuid, $data);

    expect($result)
        ->toBeInstanceOf(User::class);
});
