<?php

namespace App\Listeners;

use App\Actions\Transfer\ClosePlayerListingAction;
use App\Events\TransferCompleted;

class ClosePlayerListing
{
    /**
     * Create the event listener.
     */
    public function __construct(private readonly ClosePlayerListingAction $closePlayerListingAction)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TransferCompleted $event): void
    {
        $this->closePlayerListingAction->execute($event->listing);
    }
}
