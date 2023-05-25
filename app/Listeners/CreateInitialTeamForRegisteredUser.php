<?php

namespace App\Listeners;

use App\Actions\Team\CreateInitialTeamAction;
use App\Events\UserRegistered;

class CreateInitialTeamForRegisteredUser
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected readonly CreateInitialTeamAction $createInitialTeamAction,
    ) {
        //
    }

    /**
     * Handle the event.
     *
     * @throws \Exception
     */
    public function handle(UserRegistered $event): void
    {
        $this->createInitialTeamAction->execute($event->user, $event->country, $event->teamName);
    }
}
