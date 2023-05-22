<?php

namespace App\Http\Controllers\TransferMarket;

use App\Actions\Team\BuyPlayerAction;
use App\Http\Controllers\Controller;
use App\Models\PlayerListing;
use App\Models\Team;
use Illuminate\Http\Response;

class BuyListedPlayerController extends Controller
{
    public function __invoke(int $listingId, BuyPlayerAction $buyPlayerAction): Response
    {
        $user = auth()->user();
        /** @var Team $team */
        $team = $user->team;
        $listing = PlayerListing::where('id', $listingId)->sharedLock()->lockForUpdate()->first();

        if (! $listing->is_open) {
            return $this->badRequest('The listing has been closed');
        }
        if (! $team->checkBalance($listing->asking_price)) {
            return $this->badRequest(__('Insufficient balance'));
        }
        $transfer = $buyPlayerAction->execute($listing, $team);

        return $this->created($transfer);
    }
}
