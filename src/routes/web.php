<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;

Route::middleware('auth')->group(function () {
    Route::get('/', [RegisteredUserController::class, 'index']);
    Route::post('/stamp', [RegisteredUserController::class, 'store']);

    Route::get('/stamp/start', [RegisteredUserController::class, 'start']);
    Route::get('/stamp/end', [RegisteredUserController::class, 'end']);
    Route::get('/stamp/start_break', [RegisteredUserController::class, 'startBreak']);
    Route::get('/stamp/end_break', [RegisteredUserController::class, 'startBreak']);
});

