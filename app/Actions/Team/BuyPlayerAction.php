<?php

namespace App\Actions\Team;

use App\Actions\Transfer\StoreTransferAction;
use App\Enums\TransactionType;
use App\Events\TransferCompleted;
use App\Models\PlayerListing;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class BuyPlayerAction
{
    public function __construct(
        private readonly AttachPlayerToTeamAction $attachPlayerToTeamAction,
        private readonly AdjustTeamBalanceAction $adjustTeamBalanceAction,
        private readonly StoreTransferAction $storeTransferAction
    ) {
    }

    /**
     * @throws \Exception
     */
    public function execute(PlayerListing $playerListing, Team $team): \App\Models\Transfer
    {
        $budget = $team->balance;
        $price = $playerListing->asking_price;
        if ($budget >= $playerListing->asking_price) {
            try {
                DB::beginTransaction();

                $transferTransaction = $this->adjustTeamBalanceAction->execute($team, $price, TransactionType::DEBIT);
                $this->adjustTeamBalanceAction->execute($playerListing->team, $price, TransactionType::CREDIT);

                $this->attachPlayerToTeamAction->execute($playerListing->player, $team);
                $transfer = $this->storeTransferAction->execute($playerListing, $team, $transferTransaction);

                event(new TransferCompleted($playerListing));

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } else {
            throw new \Exception('Insufficient funds to buy the player.');
        }

        return $transfer;
    }
}
