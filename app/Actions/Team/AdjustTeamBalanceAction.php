<?php

namespace App\Actions\Team;

use App\Enums\TransactionType;
use App\Models\Team;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\DB;

class AdjustTeamBalanceAction
{
    /**
     * @throws Exception
     */
    public function execute(Team $team, int $amount, TransactionType $type): Transaction
    {
        $transaction = null;
        try {
            DB::beginTransaction();
            if ($type == TransactionType::CREDIT) {
                $team->balance += $amount;
                $description = 'Budget credited with amount: '.$amount;
            } else {
                if ($team->balance < $amount) {
                    throw new Exception('Insufficient funds to debit the requested amount.');
                }
                $team->balance -= $amount;
                $description = 'Budget debited with amount: '.$amount;
            }
            $team->save();
            $transaction = $team->transactions()->create([
                'type' => $type,
                'amount' => $amount,
                'description' => $description,
            ]);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        /** @var Transaction $transaction */
        return $transaction;
    }
}
