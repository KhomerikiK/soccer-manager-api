<?php

namespace App\Listeners;

use App\Actions\Player\CreatePlayerAction;
use App\Actions\Team\AttachPlayerToTeamAction;
use App\Events\InitialTeamCreated;
use App\Models\Country;
use App\Models\Position;
use App\Models\Team;

class GenerateInitialSquad
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private readonly CreatePlayerAction $createPlayerAction,
        private readonly AttachPlayerToTeamAction $attachPlayerToTeamAction
    ) {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(InitialTeamCreated $event): void
    {
        $positionMapping = $this->getSchema();
        foreach ($positionMapping as $position => $number) {
            $this->generatePostionPlayers($position, $number, $event->team);
        }
    }

    private function getSchema(): array
    {
        return [
            'GK' => 3,
            'DF' => 6,
            'MF' => 6,
            'AT' => 5,
        ];
    }

    private function generatePostionPlayers(string $abbreviation, int $number, Team $team): void
    {
        $position = Position::where('abbreviation', $abbreviation)->first();
        for ($i = 0; $i < $number; $i++) {
            $country = Country::inRandomOrder()->first();
            $player = $this->createPlayerAction->execute(
                fake()->firstName,
                fake()->lastName,
                rand(18, 40),
                toBaseUnit(1000000),
                $position,
                $country
            );
            $this->attachPlayerToTeamAction->execute($player, $team);
        }
    }
}
