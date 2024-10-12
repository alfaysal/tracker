<?php

use App\Http\Controllers\V1\UserController;
use App\Http\Controllers\V1\VaccineCenterController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::post('/registration', [UserController::class, 'registration'])
            ->middleware('throttle:5,1')
            ->name('create');

        Route::get('/vaccine-centers', [VaccineCenterController::class, 'getVaccineCenters']);
    });
});
