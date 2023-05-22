<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlayerResource;
use Illuminate\Http\Response;

class GetTeamPlayersController extends Controller
{
    public function __invoke(): Response
    {
        $team = auth()->user()->team;

        return $this->ok(PlayerResource::collection($team->players));
    }
}
