<?php

namespace App\Listeners;

use App\Actions\Player\GenerateInitialTeamAction;
use App\Events\InitialTeamCreated;

class GenerateInitialSquad
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private readonly GenerateInitialTeamAction $generateInitialTeamAction
    ) {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(InitialTeamCreated $event): void
    {
        $this->generateInitialTeamAction->execute($event->team);
    }
}
