<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('players')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\Game\Player\PlayerController::class, 'index']);

        Route::prefix('shop')->group(function() {
            Route::prefix('acquisition-of-box')->group(function () {
                Route::post('free', [\App\Http\Controllers\Api\Game\Player\Shop\AcquisitionOfBoxController::class, 'freeBoxAcquisition']);

                Route::prefix('purchase')->group(function () {
                    Route::post('internal', [\App\Http\Controllers\Api\Game\Player\Shop\AcquisitionOfBoxController::class, 'internalBoxPurchase']);

                    //Route::post('external');
                });
            });

            Route::prefix('acquisition-of-lootbox')->group(function () {
                Route::get('list/available');

                Route::post('purchase');
            });
        });

        Route::prefix('games')->group(function () {
            Route::prefix('beer-poing')->group(function () {
                Route::post('start', [\App\Http\Controllers\Api\Game\Player\Games\BeerPoingController::class, 'startNewBeerPoingGame']);
                Route::post('finish', [\App\Http\Controllers\Api\Game\Player\Games\BeerPoingController::class, 'endGame']);
            });

            Route::get('/get/history', [\App\Http\Controllers\Api\Game\Player\Games\BaseGameManagamentController::class, 'getHistoryOfGames']);
        });

        Route::prefix('avatars')->group(function () {
            Route::get('list', [\App\Http\Controllers\Api\Game\Player\AvatarController::class, 'getAllAvatarsFromPlayerLogged']);
        });

        Route::prefix('accessories')->group(function () {
            Route::get('list', [\App\Http\Controllers\Api\Game\Player\AccessoryOfPlayerController::class, 'getAllAccessoriesFromPlayerLogged']);
        });

        Route::prefix('finances')->group(function (){
            Route::prefix('deposit')->group(function (){
                Route::post('BUSD', [\App\Http\Controllers\Api\Game\Player\Deposits\BUSDDepositController::class, 'deposit']);
            });

            Route::prefix('history')->group(function () {
                Route::prefix('deposits')->group(function () {
                    Route::get('BUSD', [\App\Http\Controllers\Api\Game\Player\Deposits\BUSDDepositController::class, 'getAllDepositsForPlayer']);
                });
            });
        });
    });
});


