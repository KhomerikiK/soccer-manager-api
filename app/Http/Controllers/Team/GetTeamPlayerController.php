<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlayerResource;
use Illuminate\Http\Response;

class GetTeamPlayerController extends Controller
{
    public function __invoke(int $id): Response
    {
        $user = auth()->user();
        $player = $user
            ->team
            ->players()
            ->where('players.id', $id)
            ->firstOrFail();

        return $this->ok(new PlayerResource($player));
    }
}
