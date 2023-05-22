<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTeamRequest;
use App\Http\Resources\TeamResource;
use App\Models\User;
use Illuminate\Http\Response;

class UpdateTeamController extends Controller
{
    public function __invoke(UpdateTeamRequest $request): Response
    {
        /** @var User $user */
        $user = auth()->user();
        $team = $user->team;
        $team->update($request->validated());

        return $this->ok(new TeamResource($team->refresh()));
    }
}
