<?php

namespace App\Listeners;

use App\Actions\Team\CreateTeamAction;
use App\Events\InitialTeamCreated;
use App\Models\Country;
use Illuminate\Auth\Events\Registered;

class CreateInitialTeamForRegisteredUser
{
    /**
     * Create the event listener.
     */
    public function __construct(protected CreateTeamAction $createTeamAction)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $country = Country::find(1)->first();
        $team = $this->createTeamAction->execute($event->user, $country, 'bane');
        event(new InitialTeamCreated($team));
    }
}
