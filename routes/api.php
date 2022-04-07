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

use App\Http\Controllers\Api\Game\Player\Auth\AuthenticationController as PlayerAuthenticationController;
use App\Http\Controllers\Api\Game\Player\Auth\RegisterController as PlayerRegisterController;

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

            Route::prefix('acquisition-of-box')->group(function () {
                Route::post('/free', [\App\Http\Controllers\Api\Game\Player\AcquisitionOfBoxController::class, 'freeBoxPurchase']);
            });
        });

    });

});
