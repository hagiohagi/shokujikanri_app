<?php

use App\Http\Controllers\Researchers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Researchers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Researchers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Researchers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Researchers\Auth\NewPasswordController;
use App\Http\Controllers\Researchers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Researchers\Auth\RegisteredUserController;
use App\Http\Controllers\Researchers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;


Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest:researchers')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest:researchers');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest:researchers')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest:researchers');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest:researchers')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest:researchers')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest:researchers')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest:researchers')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth:researchers')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth:researchers')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth:researchers');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth:researchers')
                ->name('logout');

