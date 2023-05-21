<?php

namespace Tests\Feature\Auth;

test('new user can register', function () {
    $response = $this->post('/api/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'team_name' => fake('en')->words(2, true),
        'country_id' => 1,
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertNoContent();
});
