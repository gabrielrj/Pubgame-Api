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
        });

        Route::prefix('games')->group(function () {
            Route::prefix('beer-poing')->group(function () {
                Route::post('start', [\App\Http\Controllers\Api\Game\Player\Games\BeerPoingController::class, 'startNewBeerPoingGame']);
                Route::post('finish', [\App\Http\Controllers\Api\Game\Player\Games\BeerPoingController::class, 'endGame']);
            });

            Route::get('/get/history', [\App\Http\Controllers\Api\Game\Player\Games\BaseGameManagamentController::class, 'getHistoryOfGames']);
        });

        Route::prefix('avatars')->group(function () {
            Route::get('/list', [\App\Http\Controllers\Api\Game\Player\AvatarController::class, 'getAllAvatarsFromPlayerLogged']);
        });

        Route::prefix('accessories')->group(function () {
            Route::get('/list', [\App\Http\Controllers\Api\Game\Player\AccessoryOfPlayerController::class, 'getAllAccessoriesFromPlayerLogged']);
        });
    });
});


