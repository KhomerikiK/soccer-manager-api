<?php

namespace App\Listeners;

use App\Enums\TransactionType;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;

class SetInitialBalanceToRegisteredUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        //        DB::transaction(function () use ($event) {
        //            $initialAmount = toBaseUnit(5000000);
        //            $event->user->balance = $initialAmount;
        //            $event->user->save();
        //            $event->user->transactions()->create([
        //                'type' => TransactionType::CREDIT,
        //                'amount' => $initialAmount,
        //                'description' => 'Initial balance',
        //            ]);
        //        });
    }
}
