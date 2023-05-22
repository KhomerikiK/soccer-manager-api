<?php

use App\Actions\Player\CreatePlayerAction;
use App\Models\Player;
use App\Models\Position;

it('creates a new player and associates them with position', function () {
    $position = Position::factory()->create();
    $country = \App\Models\Country::first();
    $firstName = 'John';
    $lastName = 'Doe';
    $value = 1000000;
    $age = 33;
    $action = new CreatePlayerAction();

    $player = $action->execute($firstName, $lastName, $age, $value, $position, $country);

    expect($player)->toBeInstanceOf(Player::class)
        ->and($player->first_name)->toBe($firstName)
        ->and($player->last_name)->toBe($lastName)
        ->and($player->market_price)->toBe($value)
        ->and($player->position->is($position))->toBeTrue();
});
