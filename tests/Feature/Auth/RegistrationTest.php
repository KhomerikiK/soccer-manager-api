<?php

namespace Tests\Feature\Auth;


use App\Models\User;

test('new user can register', function () {
    $response = $this->post('/api/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'team_name' => fake('en')->words(2, true),
        'country_code' => 'GE',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertNoContent();
});
