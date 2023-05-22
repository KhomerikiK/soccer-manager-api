<?php

namespace App\Actions\Team;

use App\Models\Player;
use App\Models\PlayerListing;

class ListPlayerOnMarket
{
    public function execute(Player $player, int $askingPrice): PlayerListing
    {
        $team = $player->currentTeam();
        $playerListing = new PlayerListing();
        $playerListing->asking_price = $askingPrice;
        $playerListing->is_open = true;
        $playerListing->team()->associate($team);
        $playerListing->player()->associate($player);
        $playerListing->save();

        return $playerListing;
    }
}
