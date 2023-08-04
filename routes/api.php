<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PetAgeController;
use App\Http\Controllers\PetPqrsController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PetTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserAddressController;
use App\Http\Middleware\ChangeAppLocale;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['as' => 'api.', 'prefix' => 'v1', 'middleware' => [ChangeAppLocale::class]], function () {

    require __DIR__ . '/auth/auth.php';
    require __DIR__ . '/sign-up/sign-up.php';

    Route::get('landingpage', LandingPageController::class)->name('landingpage');
    Route::get('brands', BrandController::class)->name('brands');

    Route::group([
        'as' => 'category.',
        'prefix' => 'category',
    ], function () {
        Route::get('/', CategoryController::class)->name('category');
        Route::get('/{category}/sub-categories', SubCategoryController::class)->name('sub-categories');
    });

    Route::get('pet-ages', PetAgeController::class)->name('pet-ages');

    Route::get('pet-types', PetTypeController::class)->name('pet-type');

    Route::get('product/{product}/references', ReferenceController::class)->name('references');

    Route::apiResource('/product', ProductController::class, [
        'names' => [
            'index' => 'index',
            'show' => 'show',
        ]
    ])->only('index', 'show');



    Route::group(['middleware' => ['auth:api']], function () {
        /** Protecting Routes here */
        Route::apiResource('pet-pqrs', PetPqrsController::class)->except('index');
        Route::apiResource('pets', PetController::class);
        Route::apiResource('user-address', UserAddressController::class)
            ->only('index', 'store', 'destroy');
    });

});

