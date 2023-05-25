<?php

namespace App\Actions\Team;

use App\Actions\Transfer\StoreTransferAction;
use App\Enums\TransactionType;
use App\Models\Player;
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

                $playerListing->is_open = false;
                $playerListing->save();

                $this->increasePlayerValue($playerListing->player);

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

    private function increasePlayerValue(Player $player): void
    {
        $increasePercent = rand(10, 100);
        $newValue = $player->market_price * (1 + $increasePercent / 100);
        $player->market_price = $newValue;
        $player->save();

    }
}
