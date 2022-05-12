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

Route::get('/get-encrypted-data', [\App\Http\Controllers\Api\Game\Player\PlayerController::class, 'getEncryptedData']);
Route::post('/validate-encrypted-data', [\App\Http\Controllers\Api\Game\Player\PlayerController::class, 'validateEncryptedData']);


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

Route::prefix('dashboard')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('sign-in', [\App\Http\Controllers\Api\Apps\Dashboard\Auth\AuthenticationController::class, 'login']);

        //Route::prefix('sign-up');
    });
});


Route::middleware('auth:sanctum')->group(function() {
    Route::get('dteste', function () {
        return auth()->user();
    });
});
