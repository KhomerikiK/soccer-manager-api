<?php

namespace App\Actions\Team;

use App\Models\Country;
use App\Models\Team;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class CreateTeamAction
{
    public function execute(User|Authenticatable $user, Country $country, string $name): Team
    {
        $team = new Team();
        $team->name = $name;
        $team->country()->associate($country);
        $team->user()->associate($user);
        $team->save();

        return $team;
    }
}
