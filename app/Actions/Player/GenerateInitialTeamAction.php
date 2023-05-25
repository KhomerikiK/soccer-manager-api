<?php

namespace App\Actions\Player;

use App\Actions\Team\AttachPlayerToTeamAction;
use App\Models\Country;
use App\Models\Position;
use App\Models\Team;

class GenerateInitialTeamAction
{
    public function __construct(
        private readonly AttachPlayerToTeamAction $attachPlayerToTeamAction,
        private readonly CreatePlayerAction $createPlayerAction,
    ) {
    }

    public function execute(Team $team): void
    {
        $positionMapping = config('team.initial_schema');
        foreach ($positionMapping as $position => $number) {
            $this->generatePostionPlayers($position, $number, $team);
        }
    }

    private function generatePostionPlayers(string $abbreviation, int $number, Team $team): void
    {
        $position = Position::where('abbreviation', $abbreviation)->first();
        for ($i = 0; $i < $number; $i++) {
            $firstName = fake()->firstName;
            $lastName = fake()->firstName;
            $initialValue = config('team.player_default_value');

            $country = Country::inRandomOrder()->first();
            $player = $this->createPlayerAction->execute(
                $this->translate($firstName),
                $this->translate($lastName),
                rand(18, 40),
                toBaseUnit($initialValue),
                $position,
                $country
            );
            $this->attachPlayerToTeamAction->execute($player, $team);
        }
    }

    private function translate(string $str): array
    {
        $transArray = [];
        foreach (config('app.available_locales') as $locale) {
            $transArray[$locale] = $str;
        }

        return $transArray;
    }
}
