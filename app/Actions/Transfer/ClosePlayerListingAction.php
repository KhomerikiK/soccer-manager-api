<?php

namespace App\Actions\Transfer;

use App\Models\PlayerListing;

class ClosePlayerListingAction
{
    public function execute(PlayerListing $playerListing): PlayerListing
    {
        $playerListing->is_open = false;
        $playerListing->save();

        return $playerListing;
    }
}
