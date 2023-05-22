<?php

namespace Tests\Feature\Actions\Team;

use App\Actions\Team\AdjustTeamBalanceAction;
use App\Actions\Team\AttachPlayerToTeamAction;
use App\Actions\Team\BuyPlayerAction;
use App\Actions\Team\ListPlayerOnMarket;
use App\Actions\Transfer\StoreTransferAction;
use App\Enums\TransactionType;
use App\Models\Player;
use App\Models\PlayerListing;
use App\Models\Team;
use App\Models\Transaction;
use App\Models\Transfer;

it('can list player on transfer', function () {
    $action = new ListPlayerOnMarket();
    $askingPrice = 9999999999;
    $player = Player::factory()->create();
    $team = Team::factory()->create();

    $attachPlayerAction = new AttachPlayerToTeamAction();
    $attachPlayerAction->execute($player, $team);

    $listing = $action->execute($player, $askingPrice);
    expect($listing)->toBeInstanceOf(PlayerListing::class)
        ->and($listing->asking_price)->toBe($askingPrice)
        ->and($listing->is_open)->toBeTrue()
        ->and($listing->player_id)->toEqual($player->id)
        ->and($listing->team_id)->toEqual($team->id);
});

it('can credit team balance correctly', function () {
    $action = new AdjustTeamBalanceAction();
    $team = Team::factory()->create();
    $initialBalance = $team->balance;
    $creditAmount = 400000;
    $result = $action->execute($team, $creditAmount, TransactionType::CREDIT);
    expect($result)->toBeInstanceOf(Transaction::class)
        ->and($result->amount)->toEqual($creditAmount)
        ->and($team->refresh()->balance)->toEqual($initialBalance + $creditAmount);
});

it('can debit team balance correctly', function () {
    $action = new AdjustTeamBalanceAction();
    $team = Team::factory()->create();
    $initialBalance = $team->balance;
    $creditAmount = 400000;
    $result = $action->execute($team, $creditAmount, TransactionType::DEBIT);
    expect($result)->toBeInstanceOf(Transaction::class)
        ->and($result->amount)->toEqual($creditAmount)
        ->and($team->refresh()->balance)->toEqual($initialBalance - $creditAmount);
});

test('debit team balance when insufficient amount', function () {
    $action = new AdjustTeamBalanceAction();
    $team = Team::factory()->create(['balance' => 300000]);
    $initialBalance = $team->balance;
    $creditAmount = 400000;
    $result = $action->execute($team, $creditAmount, TransactionType::DEBIT);
})->throws(\Exception::class, 'Insufficient funds to debit the requested amount.');

it('store transfer correctly', function () {
    // Arrange
    $playerListing = PlayerListing::factory()->create();
    $team = Team::factory()->create();
    $transaction = Transaction::factory()->create();

    $transferService = new StoreTransferAction();

    // Act
    $transfer = $transferService->execute($playerListing, $team, $transaction);

    // Assert
    expect($transfer)->toBeInstanceOf(Transfer::class)
        ->and($transfer->playerListing)->toBe($playerListing)
        ->and($transfer->team)->toBe($team)
        ->and($transfer->transaction)->toBe($transaction);
});

test('team can buy listed player', function () {
    $team = Team::factory()->create();
    $listing = PlayerListing::factory()->create();
    $action = new BuyPlayerAction(
        new AttachPlayerToTeamAction(),
        new AdjustTeamBalanceAction(),
        new StoreTransferAction()
    );
    $transfer = $action->execute($listing, $team);
    expect($transfer)->toBeInstanceOf(Transfer::class)
        ->and($transfer->team)->toBe($team)
        ->and($transfer->playerListing)->toBe($listing)
        ->and($transfer->player)->toBe($listing->player);
});
