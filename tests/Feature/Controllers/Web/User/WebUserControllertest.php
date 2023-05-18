<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('it can view user details via web', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $this->get(route('web.view-user-details', ['uuid' => $user->uuid]))
        ->assertStatus(200);
});

test('it returns a failed response when a user cannot be found ', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $result = $this->get(route('web.view-user-details', ['uuid' => 'foo']))
        ->assertRedirect();

});

test('it returns a failed response when a user to be updated cannot be found', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

     $this->post(route('web.update-user-details', $user->uuid), [
        'email' => $user->email,
        'first_name' => 'foo',
        'last_name' => 'bar',
        'phone_number' => $user->phone_number
    ])->assertRedirect();

});

test('it can validate a update user request', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $this->post(route('web.update-user-details', $user->uuid), [
    ])->assertRedirect()
        ->assertSessionHasErrors(
            [
                'email',
                'password',
            ]
        );
});
