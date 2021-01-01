<?php

use Illuminate\Support\Facades\Route;
use Munzevi\Passcon\Http\Controllers;
use Illuminate\Contracts\Auth\MustVerifyEmail;

//* User Authentication Routes
Route::prefix('api/user')->name('user.')->group(function(){
    Route::middleware('guest')->group(function(){
        Route::post( 'register' , [ Controllers\User\RegisterController::class ,'store']);
        Route::post('login', [ Controllers\User\LoginController::class, 'login' ]);
    });
    Route::middleware(['auth:api','verified'])->group(function(){
        Route::get( 'detail', [ Controllers\User\DetailController::class, 'show' ]);
        Route::post( 'update', [ Controllers\User\UpdateController::class, 'update' ]);
        Route::post( 'logout', [ Controllers\User\LoginController::class, 'logout' ]);
    });
});

//* Email Verification Routes passcon::reset-password-mail
Route::prefix("email")->group(function(){
    Route::get("verify/{id}",[Controllers\VerificationController::class, "verify"] )->name("verification.verify");
    Route::get("resend",[Controllers\VerificationController::class, "resend"] )->name("verification.resend")->middleware("auth:api");
    Route::get("verify",[Controllers\VerificationController::class, "notice"])->name("verification.notice")->middleware("auth:api");
});

//* Password Reset Routes
Route::middleware('guest')->group(function(){
    Route::get('/forgot-password',[Controllers\PasswordResetController::class, 'emailForm'])
        ->name('password.request');
    Route::post('/forgot-password',[ Controllers\PasswordResetController::class,'sendEmail'])
        ->name('password.email');
    Route::get('/reset-password/{token}',[Controllers\PasswordResetController::class,
        'resetForm'])->name('password.reset');
    Route::post('/password-update',[ Controllers\PasswordResetController::class,'resetPassword']);
});
