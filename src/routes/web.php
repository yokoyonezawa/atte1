<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// 認証が必要なルート
Route::middleware('auth')->group(function () {
    // 勤務管理ページ
    Route::get('/stamp', [RegisteredUserController::class, 'index']);
    // 勤務開始
    Route::post('/stamp/start', [RegisteredUserController::class, 'start']);
    // 勤務終了
    Route::post('/stamp/end', [RegisteredUserController::class, 'end']);
    // 休憩開始
    Route::post('/stamp/start_break', [RegisteredUserController::class, 'startBreak']);
    // 休憩終了
    Route::post('/stamp/end_break', [RegisteredUserController::class, 'endBreak']);
    // 勤務時間の確認ページ
    Route::get('/attendance', [RegisteredUserController::class, 'attendance']);
});

// ログアウトルート
Route::post('/logout', [RegisteredUserController::class, 'logout']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
