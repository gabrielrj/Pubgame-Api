<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::get('user', [\App\Http\Controllers\Api\Apps\Dashboard\Auth\AuthenticationController::class, 'getUserLogged']);
    });
