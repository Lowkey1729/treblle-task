<?php

use App\Models\User;

test('it can view user details', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $this->getJson(route('view-user-details'))
        ->assertStatus(200);
});

test('it can validate a update user request', function () {
    $user = User::factory()->create();

    $this->actingAs($user, 'sanctum');

    $result = $this->putJson(route('update-user-details'), [
    ])->assertStatus(422)
        ->json();

    expect($result)
        ->toBeArray()
        ->status->toBeString()->toBe('failed')
        ->errorMessage->toBeString()
        ->data->toBe([]);
});
