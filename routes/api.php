<?php

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
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::get('team', \App\Http\Controllers\Team\GetTeamController::class);
    Route::get('team/players', \App\Http\Controllers\Team\GetTeamPlayersController::class);
    Route::get('team/players/{id}', \App\Http\Controllers\Team\GetTeamPlayerController::class);
    Route::post('team/players/{id}/list', \App\Http\Controllers\Team\ListTeamPlayerOnMarketController::class);
    Route::get('market-data', \App\Http\Controllers\TransferMarket\GetMarketDataController::class);
    Route::post('market-data/{listingId}/buy', \App\Http\Controllers\TransferMarket\BuyListedPlayerController::class);
});
