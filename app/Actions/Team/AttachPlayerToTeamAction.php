<?php

namespace App\Actions\Team;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class AttachPlayerToTeamAction
{
    public function execute(Player $player, Team $team): Player
    {
        return DB::transaction(function () use ($player, $team) {
            // Deactivate all other team relations for the player.
            $player->teams()->updateExistingPivot($player->teams->pluck('id'), ['is_active' => false]);
            // Attach the player to the team and set is_active to true.
            $player->teams()->attach($team, ['is_active' => true]);

            return $player;
        });
    }
}
