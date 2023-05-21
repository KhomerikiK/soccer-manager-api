<?php

namespace App\Actions\Team;

use App\Models\Country;
use App\Models\Player;
use App\Models\Position;

class CreatePlayerAction
{
    public function execute(string $firstName, string $lastName, int $age, int $price, Position $position, Country $country): Player
    {
        $player = new Player;
        $player->first_name = $firstName;
        $player->last_name = $lastName;
        $player->market_price = $price;
        $player->age = $age;
        $player->position()->associate($position);
        $player->country()->associate($country);
        $player->save();

        return $player;
    }
}
