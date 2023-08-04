<?php


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'auth.',
    'prefix' => 'auth',
], function () {
    Route::post('social/{driver}', [SocialiteController::class, 'callback']);
    Route::post('login', [LoginController::class, 'authenticate']);
    Route::post('logout', [LoginController::class, 'logout']);

    Route::group([
        'prefix' => 'password',
        'as' => 'password.',
        'controller' => PasswordResetController::class,
    ], function (){

        Route::post('send-reset-code','sendResetCode');
        Route::post('verify','verifyResetPasswordAttempt');
        Route::post('resend','resendResetPassword');
        Route::post('reset','resetPasswordCode');
    });

});

