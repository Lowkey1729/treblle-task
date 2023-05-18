<?php

use App\Actions\User\UserAction;
use App\Exceptions\UserError;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

beforeEach(function () {
    $this->userAction = app(UserAction::class);
});

test('it returns the details of the authenticated user', function () {
    $user = User::factory()->create();

    $result = $this->userAction->viewUserDetails($user);

    expect($result)
        ->toBeInstanceOf(User::class);
});


test('it can update the user details ', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $data = [
        'email' => 'mojeed@gmail.com',
        'first_name' => 'Olarewaju',
        'last_name' => 'Mojeed',
        'phone_number' => '+234901078012'
    ];
    $result = $this->userAction->editUserDetails($user, $data);

    expect($result)
        ->toBeInstanceOf(User::class);
});
