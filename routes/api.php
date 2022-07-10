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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

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
]);
