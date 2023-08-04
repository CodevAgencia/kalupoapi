<?php

use App\Http\Controllers\Signup\SignUpController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'sign-up.',
    'prefix' => 'sign-up',
    'controller' => SignUpController::class
], function () {
    Route::post('social-media/{driver}', 'socialMedia');
    Route::post('basic', 'basic');
});
