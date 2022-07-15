<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', '\App\Http\Controllers\Auth\LoginController@authentication');
Route::delete('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('/registration', '\App\Http\Controllers\Auth\RegistrationController');

Route::group(['prefix' => 'email'], function() {
    Route::get('/verify/{id}/{hash}', '\App\Http\Controllers\Auth\VerifyEmailController@verifyEmail')
        ->name('verification.verify')
        ->middleware('signed');
    Route::post('/verification-notification', '\App\Http\Controllers\Auth\VerifyEmailController@resendEmail')
        ->name('verification.send');
});

Route::apiResources([
    'accommodation' => \App\Http\Controllers\Api\AccommodationController::class,
    'categories' => \App\Http\Controllers\Api\CategoryController::class,
    'facilities' => \App\Http\Controllers\Api\FacilityController::class,
    'opportunities' => \App\Http\Controllers\Api\OpportunityController::class,
    'stars' => \App\Http\Controllers\Api\StarController::class,
    'reservations' => \App\Http\Controllers\Api\ReservationController::class,
    'units' => \App\Http\Controllers\Api\AccommodationUnitController::class,
    'user/histories' => \App\Http\Controllers\Api\UserRentHistoryController::class,
    'users' => \App\Http\Controllers\Api\UserController::class,
]);

Route::get('/payment', '\App\Http\Controllers\Api\AccommodationPaymentMethodController');
