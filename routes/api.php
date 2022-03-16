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

Route::get('/isconnected', function () {
    return response()->json(['success' => true, 'isconnected' => true]);
});


/**
 * Authentication Group
 */
Route::prefix('game')->group(function () {
    Route::prefix('auth')->group(function () {

        Route::prefix('players')->group(function () {

            Route::post('login', [PlayerAuthenticationController::class, 'loginWithEmailAndPassword']);

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
            return \request()->user();
        });

    });

});
