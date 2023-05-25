<?php

namespace App\Actions\Player;

use App\Models\Player;

class IncreasePlayerValueAction
{
    public function execute(Player $player): void
    {
        $increasePercent = rand(10, 100);
        $newValue = $player->market_price * (1 + $increasePercent / 100);
        $player->market_price = $newValue;
        $player->save();
    }
}
