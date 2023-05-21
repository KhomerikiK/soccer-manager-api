<?php

use App\Actions\Team\AttachPlayerToTeamAction;
use App\Models\Player;
use App\Models\Team;

it('attaches a player to a team and deactivates other team relations', function () {
    $player = Player::factory()->create();
    $team = Team::factory()->create();
    $action = new AttachPlayerToTeamAction();

    $attachedPlayer = $action->execute($player, $team);

    expect($attachedPlayer)->toBeInstanceOf(Player::class)
        ->and($attachedPlayer->currentTeam()->is($team))->toBeTrue()
        ->and($attachedPlayer->teams()->count())->toBe(1)
        ->and($player->teams->where('id', '<>', $team->id)->count())->toBe(0);
});
