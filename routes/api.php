<?php

use App\Http\Controllers\Api\Game\Player\Auth\AuthenticationController as PlayerAuthenticationController;
use App\Http\Controllers\Api\Game\Player\Auth\RegisterController as PlayerRegisterController;
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

Route::get('/isconnected', function () {
    return response()->json(['success' => true, 'isconnected' => true]);
});


/**
 * Authentication Group
 */
Route::prefix('game')->group(function () {
    Route::prefix('auth')->group(function () {

        Route::prefix('players')->group(function () {
            Route::post('sign-in', [PlayerAuthenticationController::class, 'loginWithEmailAndPassword']);

            Route::post('sign-up', [PlayerRegisterController::class, 'signUp']);

            Route::post('sign-up-and-sign-in', [PlayerRegisterController::class, 'signUpAndSignIn']);

        });

    });

    Route::prefix('shop')->group(function() {
        Route::prefix('boxes')->group(function () {
            Route::get('list', [\App\Http\Controllers\Api\Game\Player\Shop\BoxesController::class, 'getBoxesAvailableForSale']);
        });
    });


});



/**
 *
 * Logged routes by sanctum
 *
 */
Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('game')->group(function () {

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
        });

    });

});
