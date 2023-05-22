<?php

use App\Http\Controllers\Team\GetTeamController;
use App\Http\Controllers\Team\GetTeamPlayerController;
use App\Http\Controllers\Team\GetTeamPlayersController;
use App\Http\Controllers\Team\ListTeamPlayerOnMarketController;
use App\Http\Controllers\Team\UpdateTeamController;
use App\Http\Controllers\Team\UpdateTeamPlayerController;
use App\Http\Controllers\TransferMarket\BuyListedPlayerController;
use App\Http\Controllers\TransferMarket\GetMarketDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

require __DIR__.'/auth.php';

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->name('user');

    Route::prefix('v1')->group(function () {
        Route::prefix('team')->group(function () {
            Route::get('/', GetTeamController::class)->name('team.get');
            Route::patch('/', UpdateTeamController::class)->name('team.update');
            Route::prefix('/players')->group(function () {
                Route::get('/', GetTeamPlayersController::class)->name('team.players.get');
                Route::prefix('/{id}')->group(function () {
                    Route::get('/', GetTeamPlayerController::class)->name('team.player.get');
                    Route::patch('/', UpdateTeamPlayerController::class)->name('team.player.update');
                    Route::post('/list', ListTeamPlayerOnMarketController::class)->name('team.player.list');
                });
            });

        });

        Route::prefix('market-data')->group(function () {
            Route::get('/', GetMarketDataController::class)->name('market.get');
            Route::post('/{listingId}/buy', BuyListedPlayerController::class)->name('market.buy');
        });
    });
});
