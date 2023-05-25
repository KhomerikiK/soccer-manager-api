<?php

namespace App\Listeners;

use App\Actions\Player\IncreasePlayerValueAction;
use App\Events\TransferCompleted;

class IncreazePlayerMarketValue
{
    /**
     * Create the event listener.
     */
    public function __construct(private readonly IncreasePlayerValueAction $increasePlayerValueAction)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TransferCompleted $event): void
    {
        $player = $event->listing->player;
        $this->increasePlayerValueAction->execute($player);
    }
}
