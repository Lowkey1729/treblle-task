<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;

test('it validates login request', function () {

    $this->post(route('auth-web.login-user'), [])
        ->assertRedirect()
        ->assertSessionHasErrors(
            [
                'email',
                'password',
            ]
        );
});

test('it successfully registers user', function (){
    $user = User::factory()->create();
    $data = [
        'email' => $user->email,
        'password' => 'password',
    ];
    $result = $this->post(route('auth-web.login-user'), $data);

    $this->assertAuthenticated();
    $result->assertRedirect(RouteServiceProvider::HOME);
});


test('it returns 401 when an unauthenticated user tries to logout', function () {
    $this->getJson(route('auth.logout-user'))
        ->assertStatus(401);
});

test('user session destroys after token has been deleted', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'web');

    $this->get(route('auth-web.logout-user'))
        ->assertRedirect();

});
