<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;

class GetTeamController extends Controller
{
    public function __invoke()
    {
        $team = auth()->user()->team;

        return $this->ok(new TeamResource($team));
    }
}
