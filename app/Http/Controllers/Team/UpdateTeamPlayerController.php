<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Models\User;
use Illuminate\Http\Response;

class UpdateTeamPlayerController extends Controller
{
    public function __invoke(UpdatePlayerRequest $request, int $playerId): Response
    {
        /** @var User $user */
        $user = auth()->user();
        $player = $user->getTeamPlayer($playerId);
        $player->update($request->validated());

        return $this->ok(new PlayerResource($player->refresh()));
    }
}
