<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Auth::routes(['verify' => true]);

Route::post('/register', [RegisteredUserController::class, 'store']);

Route::middleware('auth')->group(function () {

    Route::get('/stamp', [RegisteredUserController::class, 'index']);

    Route::post('/stamp/start', [RegisteredUserController::class, 'start']);

    Route::post('/stamp/end', [RegisteredUserController::class, 'end']);

    Route::post('/stamp/start_break', [RegisteredUserController::class, 'startBreak']);

    Route::post('/stamp/end_break', [RegisteredUserController::class, 'endBreak']);

    Route::get('/attendance', [RegisteredUserController::class, 'attendance']);
});



Route::post('/logout', [RegisteredUserController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
