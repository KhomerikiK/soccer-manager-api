<?php

namespace App\Actions\Team;

use App\Enums\TransactionType;
use App\Events\InitialTeamCreated;
use App\Models\Country;
use App\Models\User;

class CreateInitialTeamAction
{
    public function __construct(
        protected readonly CreateTeamAction $createTeamAction,
        protected readonly AdjustTeamBalanceAction $adjustTeamBalanceAction
    ) {
        //
    }

    /**
     * @throws \Exception
     */
    public function execute(User $user, Country $country, string $teamName): void
    {
        $initialBalance = config('team.default_balance');
        $team = $this->createTeamAction->execute($user, $country, $this->translate($teamName));
        $this->adjustTeamBalanceAction->execute($team, $initialBalance, TransactionType::CREDIT);
        event(new InitialTeamCreated($team));
    }

    /**
     * TODO:: remove duplicate, implement translation logic
     */
    private function translate(string $str): array
    {
        $transArray = [];
        foreach (config('app.available_locales') as $locale) {
            $transArray[$locale] = $str;
        }

        return $transArray;
    }
}
