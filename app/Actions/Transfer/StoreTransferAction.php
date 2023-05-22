<?php

namespace App\Actions\Transfer;

use App\Models\PlayerListing;
use App\Models\Team;
use App\Models\Transaction;
use App\Models\Transfer;

class StoreTransferAction
{
    public function execute(PlayerListing $playerListing, Team $team, Transaction $transaction): Transfer
    {
        $transfer = new Transfer();
        $transfer->playerListing()->associate($playerListing);
        $transfer->player()->associate($playerListing->player);
        $transfer->team()->associate($team);
        $transfer->transaction()->associate($transaction);

        return $transfer;
    }
}
