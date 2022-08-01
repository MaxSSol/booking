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
    'user/payment/methods' => \App\Http\Controllers\Api\UserPaymentMethodController::class,
    'user/accommodation' => \App\Http\Controllers\Api\UserAccommodationController::class,
    'user/units' => \App\Http\Controllers\Api\UserAccommodationUnitController::class,
    'user/rent' => \App\Http\Controllers\Api\RentInfoController::class,
    'payment/methods' => \App\Http\Controllers\Api\PaymentMethodController::class,
    'cities' => \App\Http\Controllers\Api\CityController::class,
    'owner/rent/histories' => \App\Http\Controllers\Api\OwnerRentHistoryController::class,
]);


Route::group(['prefix' => 'user/image'], function() {
   Route::post('/upload','\App\Http\Controllers\UserImageController@upload');
   Route::post('/delete', '\App\Http\Controllers\UserImageController@delete');
});

Route::group(['prefix' => 'accommodation/image'], function() {
    Route::post('/upload/{id}', '\App\Http\Controllers\AccommodationImageController@upload');
    Route::post('/delete', '\App\Http\Controllers\AccommodationImageController@delete');
});

Route::group(['prefix' => 'accommodation/units/image'], function() {
    Route::post('/upload/{id}', '\App\Http\Controllers\AccommodationUnitImageController@upload');
    Route::post('/delete', '\App\Http\Controllers\AccommodationUnitImageController@delete');
});

Route::get('/payment', '\App\Http\Controllers\Api\AccommodationPaymentMethodController');
Route::get('/owner/status', '\App\Http\Controllers\OwnerController');
Route::get('/unit/facilities', function () {
    return response()->json(['facilities' => \App\Models\Facility::all()]);
});
