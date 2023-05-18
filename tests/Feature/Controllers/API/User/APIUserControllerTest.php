<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('it can view user details', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $this->getJson(route('view-user-details', ['uuid' => $user->uuid]))
        ->assertStatus(200);
});

test('it returns a failed response when a user cannot be found ', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $result = $this->getJson(route('view-user-details', ['uuid' => 'foo']))
        ->assertStatus(404)
        ->json();

    expect($result)
        ->toBeArray()
        ->status->toBeString()->toBe('failed')
        ->errors->toBeArray()
        ->data->toBe([])
        ->errorMessage->toBeString()->toBe('User does not exist');
});

test('it returns a failed response when a user to be updated cannot be found', function () {
    $user = User::factory()->create();

    $this->actingAs($user, 'sanctum');

    $result = $this->postJson(route('update-user-details', $user->uuid), [
        'email' => $user->email,
        'first_name' => 'foo',
        'last_name' => 'bar',
        'phone_number' => $user->phone_number
    ])->assertStatus(200)
        ->json();

    expect($result)
        ->toBeArray()
        ->status->toBeString()->toBe('success')
        ->errorMessage->toBeNull()
        ->data->toBeArray()
        ->and($result['data'])
        ->first_name->toBeString()->toBe('foo');
});

test('it can validate a update user request', function () {
    $user = User::factory()->create();

    $this->actingAs($user, 'sanctum');

    $result = $this->postJson(route('update-user-details', $user->uuid), [
    ])->assertStatus(422)
        ->json();

    expect($result)
        ->toBeArray()
        ->status->toBeString()->toBe('failed')
        ->errorMessage->toBeString()
        ->data->toBe([]);
});


