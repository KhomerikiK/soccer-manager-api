<?php

namespace App\Listeners;

use App\Actions\Team\AdjustTeamBalanceAction;
use App\Actions\Team\CreateTeamAction;
use App\Enums\TransactionType;
use App\Events\InitialTeamCreated;
use App\Models\Country;
use Illuminate\Auth\Events\Registered;

class CreateInitialTeamForRegisteredUser
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected readonly CreateTeamAction $createTeamAction,
        protected readonly AdjustTeamBalanceAction $adjustTeamBalanceAction)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $initialBalance = toBaseUnit(5000000);
        $country = Country::find(1)->first();
        $team = $this->createTeamAction->execute($event->user, $country, 'bane');
        $this->adjustTeamBalanceAction->execute($team, $initialBalance, TransactionType::CREDIT);
        event(new InitialTeamCreated($team));
    }
}
