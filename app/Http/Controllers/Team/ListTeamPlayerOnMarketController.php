<?php

namespace App\Http\Controllers\Team;

use App\Actions\Team\ListPlayerOnMarket;
use App\Http\Controllers\Controller;
use App\Http\Requests\ListTeamPlayerOnMarkerRequest;
use App\Models\User;

class ListTeamPlayerOnMarketController extends Controller
{
    public function __invoke(int $playerId, ListTeamPlayerOnMarkerRequest $request, ListPlayerOnMarket $listPlayerOnMarket)
    {
        /** @var User $user */
        $user = auth()->user();
        $player = $user->getTeamPlayer($playerId);
        if ($player->playerListings()->where('is_open', true)->exists()) {
            return $this->badRequest('the player has already been listed');
        }

        return $listPlayerOnMarket->execute($player, $request->asking_price);
    }
}
